# AGENTS.md — MakeKit Web (Public Website)

Authoritative documentation for this repository. Read this before making changes.
It is a **living document** — keep it in sync when architecture, routes, schema or
conventions change.

- **Repo**: `/home/mr/projects/makekit-web`
- **App role**: the **public-facing website** (storefront + student area)
- **Sibling app**: `/home/mr/projects/make-kit` — the **admin/back-office** CMS
- **Docker stack**: `/home/mr/projects/makekit-stack` — runs BOTH apps + one shared DB

---

## 1. The two-app ecosystem (read first)

There are **two separate CodeIgniter 3 applications that share ONE MariaDB database**.
They are siblings, not layers. Changes to the DB affect both; changes to a table's
semantics usually need a matching change in the admin app.

| | **makekit-web** (this repo) | **make-kit** (sibling) |
|---|---|---|
| Purpose | Public storefront + student self-service | Admin CMS / back-office |
| Dev URL | http://localhost:8081 | http://localhost:8082 |
| Session cookie | `ci_session_web` (files driver) | `ci_sessions` DB driver |
| Controllers | 2 (`FrontController`, `Error404`) | 15 |
| Models | 1 (`Front_model`) | 15 |
| Auth | `external_users` (parents + students) | `staff_users` + `access_groups` RBAC |

**Do not** "fix" the admin app from this repo, and do not assume the admin app's
conventions apply here. It uses `*_modal` model naming, Bootstrap 3 and a `cosmos.css`
theme; this app uses `*_model`, Bootstrap 5 and `styles.css`.

The sibling already has its own `AGENTS.md` at `/home/mr/projects/make-kit/AGENTS.md`.

---

## 2. Technology stack

| Component | Technology | Notes |
|---|---|---|
| Framework | **CodeIgniter 3.1.13** | `system/` is vendored, do not edit |
| Language | **PHP 7.4** (image `php:7.4-apache`) | code must stay PHP 7.4-compatible — **no** PHP 8 syntax (no named args, no `match`, no nullsafe `?->`, no constructor promotion) |
| Database | **MariaDB 10.4** via the `mysqli` driver | charset `utf8mb4` |
| Web server | Apache 2 + `mod_rewrite` | `AllowOverride All` set in the image |
| CSS | **Bootstrap 5.3** (local `assets/css/bootstrap.min.css`) | NOT Bootstrap 3 — the admin app is |
| JS | **jQuery 3.7.1** + Bootstrap 5 bundle | all page JS is inline in views or in `includes/js.php` |
| Icons | **Font Awesome 6.4.0** via cdnjs | local `assets/css/all.min.css` + `assets/fonts/FontAwesome*` are **dead weight** |
| Brand font | `GreycliffHebrewCF` (self-hosted woff2) | declared in `styles.css` |
| Email | **CI's own `email` library** (SMTP) | ⚠ PHPMailer is listed in `composer.json` but is **never used** and `vendor/` is gitignored/absent. The `README.md` claim about PHPMailer is wrong. |
| Direction | **Hebrew / RTL** | `<html lang="he" dir="rtl">` |

---

## 3. Running the app

The stack is already up. Useful commands:

```bash
cd /home/mr/projects/makekit-stack
docker compose ps
docker compose up -d                       # start both apps + db
docker compose down                        # stop (dbdata volume survives)
./import-db.sh                            # HARD RESET: drop + re-import the DB
docker compose exec -T db mysql -uroot -proot makekit_db_hebrew_local
```

**Ports are env-driven** (`makekit-stack/.env`): `FRONT_PORT=8081`, `ADMIN_PORT=8082`,
`DB_PORT=3308`. Check `.env` before assuming a port.

### Environment switching in this app

CI3 loads `application/config/{ENVIRONMENT}/config.php` **instead of** the root
config when it exists (`ENVIRONMENT` comes from `$_SERVER['CI_ENV']` and defaults to
`development` in `index.php`).

| File | Effect (auto-applied when `ENVIRONMENT=development`) |
|---|---|
| `application/config/development/config.php` | `base_url=http://localhost:8081/`, `sess_cookie_name=ci_session_web`, `sess_save_path=/tmp` |
| `application/config/development/database.php` | host `db`, root/root, **utf8mb4** |

`application/config/development/` is gitignored (`*`) — it is machine-local.
The committed `application/config/database.php` (localhost, empty password, `utf8`)
targets a bare XAMPP install and is what production uses.

---

## 4. Directory layout

```
makekit-web/
├── index.php                       # CI front controller (stock, ENVIRONMENT switch at L56)
├── .htaccess                       # rewrite ALL non-file/dir requests to index.php
├── composer.json / composer.lock   # phpmailer ^6.9 only; vendor/ is gitignored
├── application/
│   ├── base/Base_Controller.php    # ← autoloaded class, injects $cur = '₪'
│   ├── core/MY_Controller.php      # thin CI_Controller subclass (subclass_prefix 'MY_')
│   ├── controllers/
│   │   ├── FrontController.php     # 1809 lines — the ENTIRE application
│   │   └── Error404.php            # 404_override target
│   ├── models/Front_model.php      # 759 lines — the ENTIRE data layer
│   ├── helpers/
│   │   ├── password_helper.php     # WordPress-compatible hashing (create_wp_style_hash / verify_password_universal)
│   │   └── text_helper.php         # truncate_text()  [autoloaded]
│   ├── hooks/autoload.php          # pre_system hook: registers the base/ autoloader
│   ├── config/                     # routes, config, database, autoload, constants, hooks
│   │   └── development/            # gitignored local overrides
│   └── views/                      # 22 page views + includes/
│       ├── includes/               # head, header, footer, footer_home, js, cursor_preloader
│       │   └── account/            # user_header.php (account sidebar)
│       └── errors/                 # CI error templates (404)
├── assets/
│   ├── css/styles.css              # 940 lines — THE stylesheet for this app
│   ├── js/main.js                  # 11 lines — only the sticky-header `.scrolled` toggle
│   ├── images/, fonts/, mail/
└── system/                         # CodeIgniter core — DO NOT EDIT
```

### Autoloading chain (important, non-standard)

```
index.php
  └─ config/hooks.php  →  pre_system hook
       └─ hooks/autoload.php  →  spl_autoload_register()
            └─ any class not prefixed CI_* found in application/base/  →  auto-required
                 └─ Base_Controller extends MY_Controller extends CI_Controller
```

`$config['subclass_prefix'] = 'MY_'` makes CI look for `application/core/MY_Controller.php`.
It is **case-sensitive on Linux** — the file must stay `MY_Controller.php` (there was a
commit that fixed exactly this).

`autoload.php` loads: libraries `database`, `email`, `session`; helpers `url`, `file`, `text`.
The `cart` library and the `password` helper are loaded **per-request** in
`FrontController::__construct()`. The `pagination` library is loaded ad-hoc.

---

## 5. Request lifecycle

`FrontController::__construct()` runs on **every** request and does, in order:

1. `clear_cache()` — sends `no-store` headers (whole site is uncacheable)
2. loads `Front_model`, the `cart` library, the `password` helper
3. **auto-login from the `mk_remember` cookie** if there is no session (see §9)
4. **one** query: all `categories` rows where `status = 0`, then splits them in PHP into
   - `$categoryList` → `show_in_site == 1` → desktop bottom nav + mobile store menu
   - `$categoryListForWidget` → `show_as_widget == 1` → homepage icon row
   Both are injected into **every** view via `$this->load->vars($commonData)`.

`Base_Controller::__construct()` (runs first, via autoload) sets `$this->cur = '₪'`
and injects `$cur` into every view. It also sets `$this->folder` — **dead code**, unused.

---

## 6. Routing map

All routes are in `application/config/routes.php`. `default_controller = FrontController`,
`404_override = error404`. There are **no** default CI `controller/method` fallbacks
in use — everything is explicitly routed.

### Public pages
| URL | Controller::method | View |
|---|---|---|
| `/` | `FrontController::index` | `index` |
| `/classes` | `makeitClasses` | `classes` |
| `/wholesale` | `makeitWholesale` | `wholesale` |
| `/drawings` | `makeitDrawings` | `drawings` |
| `/contact-us` | `makeitContactUs` | `contact` |
| `/accessibility` | `makeitAccessibility` | `accessibility` |
| `/product-category/{slug}` | `makekitProducts/{slug}` | `products` |
| `/product-category/{slug}/page` | `makekitProducts/{slug}/1` | `products` |
| `/product-category/{slug}/page/{n}` | `makekitProducts/{slug}/{n}` | `products` |
| `/product/{slug}` | `makekitProductDetail/{slug}` | `product_detail` |
| `/cart` | `makekitCart` | `cart` |
| `/checkout` | `checkout` | `checkout` |
| `/student-registration` | `makekitStudentRegistraion` ⚠ *typo is real* | `student_registration` |

### Auth (JSON endpoints unless noted)
| URL | Method | Purpose |
|---|---|---|
| `/signin` | POST | login; sets `user_logged_in` + optional `mk_remember` cookie |
| `/logout` | GET | destroys session + cookie (no-op if not logged in) |
| `/register-student` | POST | student self-registration |
| `/load-intitute-circles` | GET | institute → subject cascade ⚠ *route typo "intitute"* |
| `/load-subject-instructor` | GET | subject → instructor cascade |

### Cart / checkout (JSON)
`/add-to-cart` (POST, dual-mode: single add **or** bulk `items[]` update),
`/remove-cart-item` (POST), `/apply-coupon` (POST), `/checkout/save` (POST → `placeOrder`)

### Student area
| URL | Purpose |
|---|---|
| `/my-account` | dashboard (renders `login` view if not logged in) |
| `/my-account/orders` | order history |
| `/my-account/downloads` | **static placeholder — no data source** |
| `/my-account/edit-address` | address book (primary/secondary) |
| `/my-account/save-address` | POST |
| `/get-single-address` | POST |
| `/my-account/edit-account` | profile + password |
| `/update-account` | POST |
| `/my-account/makekit-questionnaires` | questionnaire list (term 1) |
| `/my-account/medalian-questionnaires` | questionnaire list (term 2) + paper-code entry |
| `/my-account/questionnaires?formId={b64}&qtype=makekit|medalian` | take the exam |
| `/save-answers` | POST |
| `/start-medalian-exam` | POST |
| `/my-account/lost-password` | request reset form |
| `/my-account/reset?token=…` | set-new-password form |
| `/reset-password` | **POST only** (`$route['reset-password']['post']`) |
| `/update-password` | **POST only** |

> `$config['permitted_uri_chars'] = 'a-z 0-9~%.:_\-'` is **lowercase-only**. CI
> uppercases URI segments before matching them, so this works, but never rely on
> case-sensitive URL segments.

---

## 7. `FrontController::placeOrder()` — the order flow (most complex method)

Lives at `application/controllers/FrontController.php:1252`. Read it before touching
commerce. Flow:

1. `cust_id` from session, else `0` (guest checkout is allowed)
2. `order_code` = `'#' . str_pad(last_order_id + 1, 8, '0', LEFT)` ⚠ **race-prone**
3. Delivery charge: only when `shipping == 'DEL'`, takes the newest
   `delivery_charges` row by `charges_id DESC`; hardcoded fallback `50`
4. Coupon from session `coupons` → `coupon_type 0` = flat amount, `1` = percent
5. `payment_total` = cart total − coupon + delivery charge
6. Inserts an `addresses` row with `add_type = 3` (order-scoped copy), then `orders`
7. Per cart item: inserts `order_details`, **decrements `products.quantity`**,
   and — if the product's category `seo_url == 'awards'` — adds
   `minimum_eligiblity_value` to `external_users.points_spent`
   ⚠ it adds the **per-unit** value, not `value × qty`
8. Builds a large inline RTL HTML email and sends it via CI `email` (SMTP
   `smtp.hostinger.com`, from `no-reply@makesmart.co.il` — ⚠ **credentials are
   hardcoded in source at L1580-1592**). Send failures are logged, never fatal.
9. Clears the coupon session and destroys the cart

Shipping method is carried cart→checkout in **`sessionStorage['shipping_method']`**
(`DEL` | `LOCAL_PICK` | `DEL_VIA_CONTACT`), not in a server session.

---

## 8. Data access — `Front_model`

One model, one workhorse. Learn these first:

| Method | Signature / behaviour |
|---|---|
| `get_data_with_conditions_and_joins($main_table, $fields, $joins, $conditions, $limit, $orderBy)` | **The core generic query helper.** Returns `row()` when `$limit === 1`, else `result()`. Array shapes: `$joins[] = ['table','on','type']`, `$conditions[] = ['field','value']`, `$orderBy[] = ['field','order_by_type']`. |
| `fetchPage($id)` | One `pages` row (joined to its `photo`). Used with **hard-coded page IDs** — see the table in §9. |
| `fetchPageManyPics($id, $limits=0)` | All `photo` rows where `table='pages'` and `field_id=$id`, ordered by `photo_order`. |
| `getAll($table)` | `SELECT * FROM $table` — **raw table name, no escaping.** Only ever called with literals (`class`, `cities`, `question_type`). |
| `insert_me($table,$data)` / `update($idName,$id,$table,$data)` / `upsert($id,$arr,$table,$whereField)` | Thin CRUD wrappers; `update`/`upsert` use `trans_start`/`trans_complete`. |
| `get_filtered_products($cate_id,$sortType,$limit,$offset,$currentId)` | Product list. `$sortType` ∈ `price`, `price-desc`, `date`, `popularity`, `related_products` (→ `RANDOM()`), default `pro_id DESC`. N+1: fetches 2 photos per product in a loop. |
| `count_products_by_category($cate_id,$sortType)` | `count_all_results()` — ⚠ with `popularity` it LEFT-JOINs `product_attr_val` so rows with multiple matching attributes are **over-counted**. |
| `product_detail($slug)` | One product by `slug_url` + all photos + `discountList` |
| `get_product_for_cart($productId,$qty)` | Product + first photo + the **highest `min_item_count <= $qty`** discount tier |
| `checkField($table,$id,$value)` | Existence check (used for duplicate-username) |
| `register_external_user($user_id,$add_id,$user_array,$addr_array)` | Insert-or-update of a user **and** their address in one transaction |
| `my_address($user_id)` / `fetch_single_address($addType,$user_id,$addId)` | Returns `[primary, secondary]`; `false` when absent |
| `checkCouponCode($coupon)` | Validates `valid_from <= today <= valid_to` |
| `place_order($o_id,$addr_arr,$order_arr)` | Transactional address+order insert. ⚠ if `$o_id != 0` `$order_id` is **never assigned → PHP notice**. Only ever called with `0`. |
| `get_last_order()` | Highest `order_id` |
| `questionaires($class_id,$subject_id,$student_id,$term_id=1,$is_medalian=false)` | Raw-SQL sub-queries: remaining attempts, correct answers on the **last completed** attempt only. `$is_medalian` additionally requires ≥1 prior attempt. |
| `makekit_questions($paper_id)` | Paper row + per-`question_type` question/answer trees, keyed `{english_type_lower}_ques_ans` → e.g. `mcq_ques_ans` |
| `start_attempt($student_id,$paper_id)` | Reuses an `in_progress` attempt, else inserts a new one; returns `false` when the attempt quota is exhausted |
| `save_answer($student_answers)` | Splits into `insert_batch` / `update_batch` against `student_answers` |
| `is_correct_answer($question_id,$answer_id)` | `question_answers.correct_answer = 1` |
| `get_student_summary($id)` / `get_student_summary_medalian($id)` | term 1 vs term 2 variants |
| `get_total_score($studentId,$paperType)` / `get_score_list($studentId)` | Only counts the **latest attempt per paper** (correlated sub-query) |

---

## 9. Database — `makekit_db_hebrew_local`

61 tables, MariaDB 10.4, `utf8mb4_unicode_ci`. **Mixed charsets** (54 utf8mb4, 6 latin1,
1 utf8) and **mixed engines** (InnoDB + MyISAM). No migrations — schema lives in raw
SQL dumps. Tables this app touches:

### CMS
| Table | Key columns | Notes |
|---|---|---|
| `pages` | `page_id`, `page_for`, `page_type`, `seo_title/description/keywords`, `headline`, `second_title`, `page_text` (longtext HTML), `status` | `status 0` = available |
| `photo` | `table`, `field`, `field_id`, `photo_path`, `extension`, `photo_title`, `photo_header`, `psub_header`, `pdescription`, `photo_order`, `status` | **Polymorphic**: `table` ∈ `pages`, `products`, `questions`, `question_answers`, `coupons`; `field_id` points at that table's PK. `status 1` = available. Note `fetchPageManyPics` filters `pg.status=0` (the *page*, not the photo). |

Images are served from the **separate WordPress host** via the `PHOTO_DOMAIN` constant
(`http://localhost/make-kit/photos/`). Naming convention:
`{PHOTO_DOMAIN}{table}/{photo_path}-{size}.{extension}` with sizes `org` / `sma` / `std`.

### `pages.page_id` — the hard-coded content map ⚠

This is the single most important thing to know when adding a page. The controller
calls `fetchPage(<literal int>)` everywhere. **The IDs are not derived from anything.**

| ID | Content | Used by |
|---|---|---|
| 1 | home main | `index` (`pageMain`) |
| 2 | home slider | `index` (`pageSlider`, `fetchPageManyPics(2)`) |
| 3 | "want to guide with us" | `index` |
| 4 | "new on the site" | `index` |
| 5 | classes banner | `makeitClasses` |
| 6 | classes content list (photos) | `fetchPageManyPics(6)` |
| 7 | wholesale banner | `makeitWholesale` |
| 8 | wholesale content list | `fetchPageManyPics(8)` |
| 9 | drawings banner | `makeitDrawings` |
| 10 | drawings list | `fetchPageManyPics(10)` |
| 11 | contact banner | `makeitContactUs` |
| 12 | contact email | `pageEmail` |
| 13 | contact WhatsApp (`second_title` = number, `seo_url` = wa.me link) | `pageWhatsApp` |
| 14 | contact phone | `pagePhone` |
| 15 | contact address | `pageAddress` |
| 16 | cart banner | `makekitCart` |
| 17 | my-account banner | `makekitMyAccount` |
| 18 | student-registration banner | `makekitStudentRegistraion` |
| 19 | orders banner | `myOrders` |
| 20 | downloads banner | `myDownloads` |
| 21 | address banner | `myAddress` |
| 22 | edit-account banner | `editAccount` |
| 23 | questionnaire banner (shared by makekit + exam) | `makeKitQuestionairePage`, `makeKitQuestionaire` |
| 24 | checkout banner | `checkout` |
| 25 | medalian questionnaire banner | `medalianQuestionairePage` |
| 26 | password-reset banner | `lostPassword`, `updatePasswordPage` |
| 27 | accessibility statement | `makeitAccessibility` |

> IDs ≥ 28 are free. `page_type`: `0` page, `1` slider, `2` banner, `3` gallery.

### Catalogue
| Table | Key columns used |
|---|---|
| `products` | `pro_id`, `cate_id`, `name`, `price`, `quantity`, `slug_url`, `description`, `short_description`, `ingredients`, `how_to_use`, `added_date`, `status`, `credit_type_id`→`credity_type`, **`minimum_eligiblity_value`** ⚠ (note the misspelling — points cost for awards) |
| `categories` | `cate_id`, `category`, `category_second_title`, `seo_url`, `status`, `show_in_site`, `show_as_widget`, `view_count` |
| `product_discount` | `product_id`, `discount_id`, `min_item_count` — tiered discounts |
| `discount_list` | `discount_value`, `discount_type` (`0` flat, `1` percent) |
| `product_attr_val` | `pro_id`, `attr_id`, `av_id` — ⚠ `av_id = 1` is hardcoded as the "popular" flag in `get_filtered_products`/`count_products_by_category` |
| `sub_product`, `sub_pro_sepc`, `order_product_specs`, `product_categories`, `product_available_sites` | **not used by this app** (admin-side variants/multi-site) |

Current category seeds: `1 science` (widget only), `2 games`, `3 robotronic`,
`4 harkava` (last three: `show_in_site=1`), `5 awards`, `6 general`, `7 box`, `8 carpentry`,
`9 quickit`.

### Orders
| Table | Key columns |
|---|---|
| `orders` | `order_id`, `order_code`, `cust_id`, `add_id`, `cart_total`, `del_charge`, `coupon_id`, `discount`, `payment_total`, `paid_total`, `balance`, `payment_method` (`1` online / `2` COD), `payment_status` (`2` success, `0` pending, `-1` cancelled, `-2` failed, `-3` chargeback), `order_status`→`order_statuses`, `ordered_ip` |
| `order_details` | `order_id`, `pro_id`, `qty`, `act_unit_price`, `discount_percentage`, `billed_unit_price`, `subtotal` |
| `order_statuses` | `os_id`, `status` (Hebrew), `status_english` — 1 pending, 2 failed, 3 placed, 4 packaging, 5 shipped, 6 cancelled, 7 delivered, 8 return |
| `addresses` | `add_type` **`0` primary / `1` secondary / `2` staff / `3` order**, `user_type` (`1` staff, `2` external), `user_id`, `reg_id`, `country_id` |
| `cities` / `regions` / `country` | geo lookup; `cities.city_name_hebrew` is what the UI shows. ⚠ `cities` is ~2.5M rows and `fetch_single_address` INNER-JOINs it |
| `coupons` | `coupon_code`, `coupon_type` (`0` amount, `1` percent), `coupon_amount`, `valid_from/to`, `count_type`, `coupon_count` ⚠ **`count_type`/`coupon_count` are never enforced — coupons are reusable forever** |
| `delivery_charges` | `initial_charge`, `charge_per_kg` — app only ever reads the newest row and only uses `initial_charge` |

### Users / auth
| Table | Key columns |
|---|---|
| `external_users` | `id`, `user_type` (**`3` = student**, `2` = instructor per the column comment), `name`, `parent_name/phone/email` (⚠ **`parent_email` doubles as the login username**), `password`, `status` (`1` active), `class_id`, `subject_id`, `instructor_id`, `city_id`, `points_earned`, `points_spent`, `points_earned_medalian` |
| `password_resets` | `user_id`, `token`, `expires_at` — one row per user, upserted |
| `staff_users` | read-only here: `user_id`, `fname`, `lname` — instructors for the registration cascade |
| `class`, `subjects`, `class_subjects`, `subject_assign` | academic lookups for the registration cascade |
| `credity_type` | `1` normal currency, `2` makekit coin, `3` medal coin |

### Assessment
| Table | Key columns |
|---|---|
| `question_paper_main` | `paper_id`, **`term_id` (`1` = MakeKit, `2` = Medalian)**, `class_id`, `subject_id`, `school_name`, `paper_duration`, `total_marks_count`, `score_per_mcq`, `no_of_attempts`, `mcq_main_title`, `status` |
| `question_paper_child` | `paper_id`, `question_id`, `que_type` |
| `questions` | `que_id`, `class_id`, `subject`, `exam_type`, `qt_id`, `question`, `question_showing`, `has_img` |
| `question_answers` | `qa_id`, `que_id`, `answer`, `correct_answer` (`1` = correct), `has_img` |
| `question_type` | `qt_id`, `question_type_english` (`MCQ`, `STRUCTURED`, `ESSAY`) — **this value generates the array key** in `makekit_questions()` |
| `student_attempts` | `attempt_id`, `student_id`, `paper_id`, `attempt_number`, `start_time`, `end_time`, `score`, `status` enum(`in_progress`,`completed`,`abandoned`) |
| `student_answers` | `answer_id`, `attempt_id`, `question_id`, `selected_option`, `is_correct`, `marks_awarded` |
| `student_points` | `student_id`, `paper_id`, `attempt_id`, `points`, `paper_type` (`1` MakeKit, `2` Medalian) |

---

## 10. Points / "MakeKit currency" model

Students earn points by answering exam papers correctly and spend them on
**`awards` category** products. This is the most business-specific logic in the app.

- Earn: `saveAnswers()` → `student_points` row (latest attempt per paper wins) →
  `get_total_score()` → written to `external_users.points_earned` (term 1) or
  `points_earned_medalian` (term 2).
- Available balance = `points_earned − points_spent` (computed in
  `index()`, `makekitProducts()`, and `get_student_summary()`).
- **Which products are coin purchases:** those in the **`awards` category
  (`categories.seo_url = 'awards'`)**. `products.credit_type_id` (→ `credity_type`,
  where `2` = מטבע מייקקיט) is the admin's own "coin product" flag but is **never
  read by this app** — the awards category is the operative marker.
- **Cost of a line = effective unit price × quantity.** `products.price` *is* the
  coin amount for a coin purchase, so a 3-coin award bought ×3 costs 9. The cart
  already holds the discounted unit price, so the coin cost always equals the
  order line's own `subtotal`.
- Spend happens in `placeOrder()`: the total coin cost of the cart is computed and
  balance-checked **before any row is written**, then each coin line commits via
  `Front_model::deduct_points()`, which increments `points_spent` in SQL
  (`points_spent = points_spent + ?`) so concurrent orders cannot clobber each other.
- Buying a coin product requires a logged-in student with sufficient balance; both
  are enforced server-side and return a Hebrew error. Awards are additionally
  UI-capped to qty 1 (`index.php`, `products.php`) but that cap is **not**
  server-enforced — only the balance is.

> ⚠ Known gaps in this area, not yet decided: a coin product's `price` is still
> added to `orders.cart_total` / `payment_total` in **shekels** as well, so a coin
> purchase currently also bills real money; and the product cards display
> `מייקיטים {minimum_eligiblity_value}` (`index.php`, `products.php`) rather than
> the `price` actually charged — `minimum_eligiblity_value` is NULL for every
> product in the local DB. Both need a product-owner decision.

---

## 11. Views & layout system

Every page view is a full standalone document — there is no layout inheritance.
The mandatory skeleton is:

```php
<!DOCTYPE html>
<html lang="he" dir="rtl">
<head>
    <?php $this->load->view('includes/head'); ?>
</head>
<body>
    <?php $this->load->view('includes/header'); ?>
    <main> …page content… </main>
    <?php $this->load->view('includes/footer') ?>
    <?php $this->load->view('includes/js') ?>
    <script> /* page JS inline */ </script>
</body>
</html>
```

`includes/header.php` depends on globals injected by the constructor:
`$activePage`, `$categoryList`, `$selectedCate`, `$this->cart`.
`includes/head.php` switches the `<title>` on `$activePage` and overrides it with
`$pageMain->seo_title` when present. `includes/account/user_header.php` (the account
sidebar) needs `$activeUserPage`.

`$activePage` values: `HOME CLASS WHOLESALE DRAWINGS CONTACT ACCESSIBILITY CART PRODUCT
MY-ACCOUNT STUDENT-REGISTRATION`.
`$activeUserPage` values: `MY_ACCOUNT MY_ORDERS MY_DOWNLOADS MY_ADDRESS EDIT_ACCOUNT
MAKEKIT_QUESTIONAIRE MEDALIAN_QUESTIONAIRE CHECKOUT RESET_PWD`.

> `includes/footer_home.php` is **dead** — legacy English/"Arbol Soft"/WooCommerce
> markup referencing undefined `$footerServices`, `$socialMediaLinks`, `$newsLetter`.

### AJAX convention

There is no REST layer. Every AJAX endpoint:
1. wraps its body in `try { … } catch (Exception $ex) { … }`
2. sets `$message = ['status' => 'success'|'error', 'message' => …]`
3. `echo json_encode($message);` with **no Content-Type header** — clients must
   call `$.parseJSON(result)`, which every view does
4. throws bare `Exception` with a **Hebrew** message for user-facing errors

Client side: `$.ajax({url: '<?=base_url()?>endpoint', type:'POST', data:…})` →
`$.parseJSON` → inspect `resp.status` → inject `resp.message` into a Bootstrap alert.

`includes/js.php` provides the shared `formatCurrency(amount, currencySymbol)`.

---

## 12. Frontend design system

### CSS custom properties (`assets/css/styles.css` `:root`, L23-39)
| Token | Value | Use |
|---|---|---|
| `--dingy-dungeon` | `#cf2b52` | **primary brand red** — bottom nav, hero button |
| `--crayolas-maize` | `#fec04f` | accent yellow — nav active/hover |
| `--royal-orange` | `#fd8c44` | contact icon |
| `--light-sea-green` | `#2da4a8` | wholesale card |
| `--lapis-lazuli` | `#296094` | links, `btn-add-to-cart`, universal hover |
| `--american-purple` | `#3f1f56` | body text |
| `--contrast` / `--contrast-2` / `--contrast-3` | `#757575` / `#575760` / `#b2b2be` | greys |
| `--base` / `--base-2` / `--base-3` | `#efeded` / `#f7f8f9` / `#f8f8f8` | surfaces |
| `--brand-grey-light` / `--brand-grey-medium` | `#f7f7f7` / `#eeeeee` | mobile toggler |

`--icon-bg-color` / `--icon-text-color` are set **inline per element** from
`$categoryIcons` in `views/index.php` and `views/contact.php`.
⚠ `--base-1` is referenced at L598 but never declared.

### Key component classes
`.site-header` (+`.scrolled`) · `.desktop-header` · `.mobile-header-top` ·
`#mainMenuMobile` (fullscreen overlay) · `#storeMenuMobile` · `.curved-button`
(`border-radius:75px 75px 50px 50px`) · `.underline-heading-1` +
`.container-underline` · `.banner-section` · `.hero-section` · `.icon-section` /
`.feature-icon` / `.icon-circle` · `.product-section` / `.product-card` /
`.product-img.img-main` / `.img-hover` (crossfade) / `.price` /
`.btn-add-to-cart` · `.products.disabled` (`::after { content:"Unavailable" }`) ·
`.cart-table` · `.summary-table` · `.user-sidebar-menu` · `.site-footer` ·
`.logo-footer` · `.social-icon` · `.payment-icons`

### Breakpoints
`styles.css` has exactly **one** media query (`max-width: 767.98px`, the cart
table card-ification). All other responsiveness comes from **Bootstrap 5 utility
classes in the markup**: `d-none d-lg-block` / `d-lg-none` switch the desktop and
mobile headers at **992px**; `d-md-*` at 768px; `d-xl-*` at 1200px.

### RTL strategy
`dir="rtl"` on `<html>` is the *only* mechanism. There are **zero** RTL-specific CSS
rules (no `[dir=rtl]`, no logical properties). Direction is handled by:
1. `dir="rtl"` on `<html>`
2. Bootstrap `flex-row-reverse` / `flex-column-reverse` utilities on nav lists
3. CSS `order` on the scrolled mobile header (`.site-header.scrolled .icon-basket { order: 2 }` etc.)
4. Hard-coded physical properties (`margin-right`, `text-align: right`, `left: 0`)

**Consequence:** when adding a layout, prefer `*-start`/`*-end` and `*-row-reverse`
utilities over hard-coded `left`/`right`.

### Fonts actually in use
`GreycliffHebrewCF` (Light for body, Bold for headings). The local Font Awesome files
and the Google-Fonts `Assistant` family are loaded but **unused** by the CSS.
`assets/js/main.js` contains only the sticky-header toggle and will throw if
`.site-header` is missing — add a null-guard if you ever reuse it elsewhere.

---

## 13. Auth, session, security

### Session
`user_logged_in` is an **array**, not a string:
```php
['user_id' => 1, 'name' => '…', 'user_type' => 3]
```
Read it as `$this->session->userdata['user_logged_in']['user_id']` (direct array
access) or `$this->session->userdata('user_logged_in')` for existence checks.
Guard pages with the private `check_login_redirect()` helper
(`FrontController.php:826`) which redirects to `my-account`.

Session config: `files` driver, 7200s expiry, 300s id rotation, `samesite=Lax`,
`cookie_httponly` = **FALSE** in the committed config.

### "Remember me" (`mk_remember` cookie)
Set on login when `remember_me` is posted, valid 30 days. Payload is
`{uid, exp, sig}` where `sig = HMAC-SHA256(uid|exp, encryption_key)`. The
constructor re-validates it on every request and re-logs the user in. This **is**
sound (signed, expiry-checked, status-checked) — but it depends on
`$config['encryption_key']` not being the committed placeholder.

### Password hashing (`application/helpers/password_helper.php`)
- `create_wp_style_hash($pw)` → `'$wp' . bcrypt(base64(hmac_sha384($pw, 'wp-sha384')))`
- `verify_password_universal($pw, $hash)` accepts three generations:
  1. `$wp$…` — modern WordPress bcrypt
  2. `$P$…` / `$H$…` — legacy WordPress PHPass (md5 iterated)
  3. plain `bcrypt` — from the old `get_encrypted_password()` on `Base_Controller`

Passwords are **never** auto-upgraded on login (the rehash block at L358 is
commented out). New writes always use `create_wp_style_hash`.

### Security posture ⚠ (read before adding endpoints)
- **CSRF is globally disabled** (`csrf_protection = FALSE`) and no AJAX call sends a token.
- `global_xss_filtering = FALSE`; views use short-echo `<?=$var?>` **without**
  `html_escape()`. Raw HTML from the DB (`pages.page_text`, `photo.pdescription`,
  `questions.question`, `question_answers.answer`, `photo.photo_header`) is echoed
  straight into the DOM. Any CMS author is effectively an XSS source.
- Client code injects `resp.message` with `.html()` into alerts.
- SMTP credentials are hardcoded in `FrontController.php:1580-1592`.
- `updateAccount()` trusts a **client-supplied `user_id`** instead of the session —
  IDOR: a logged-in user can edit any account. Same in `updateAccount` for the
  address lookup.
- `addToCart` does not re-verify stock. `placeOrder` now **does** enforce the
  makekit-coin balance server-side (see §10), but neither re-checks stock at
  checkout time.
- `.htaccess` has no `Options -Indexes` and no deny rules for `application/`,
  `system/`, `composer.*` — in a document-root deployment those are web-readable.
- No tests, no linter, no static analysis configured.

---

## 14. Known bugs & technical debt

Ordered roughly by how likely you are to trip over them.

**Functional**
1. `saveAddress()` L927-933 — `if ($add_id == 0) { … } { … }`: the second block is
   an unconditional fall-through, so the "updated" message always overwrites the
   "saved" one. Inserting a new address reports "updated".
2. `placeOrder()` — order codes are `MAX(order_id)+1`, not atomic; concurrent checkouts collide.
3. `placeOrder()` — the stock decrement is also a read-modify-write
   (`upsert(..., ['quantity' => $getProduct->quantity - $item['qty']])`). Two
   concurrent orders both read the same quantity and both write the same result,
   so the second is silently lost. Verified: stock 10, two parallel orders of 2
   each → stock 8 instead of 6. The coin increment is atomic by contrast (see §10).
4. `placeOrder()` — **stock is never re-checked at order time**, only in
   `addToCart`. If stock drops to 0 after the item is in the cart the order still
   succeeds and `products.quantity` goes **negative**. Coins are still deducted for
   the undeliverable units. Fix by validating the whole cart's stock in the same
   pre-order pass as the coin balance.
5. ~~`placeOrder()` — `$item['options']['category_url']` is read without `isset()`~~
   **Fixed.** The awards branch now reads the category from the database
   (`get_coin_products()`) instead of the client-populated cart option.
6. ~~`placeOrder()` — points spent adds `minimum_eligiblity_value` per line, not
   per unit, and only after the order rows are written, with no balance check and
   no guest guard.~~ **Fixed** — see §10.
7. `get_product_for_cart()` — `if ($q->num_rows() === 1)` after a `LEFT JOIN photo`
   means a product with **two or more photos returns `false`** and cannot be added
   to the cart at all. Pre-existing, unrelated to coins.
8. `addToCart()` bulk mode — `$htmlPrice[$rowId]` uses `$rowId` from a `foreach` that
   may not have run (product not found / over stock), producing an undefined-index notice.
9. `coupons.count_type` / `coupon_count` are never checked — unlimited reuse.
10. `get_filtered_products()` and `product_detail()` — N+1 photo queries (1 query per product).
11. `count_products_by_category()` over-counts with the `popularity` join.
12. `myDownloads` is a hard-coded empty placeholder; the controller passes no data.
13. `makeKitQuestionaire()` — `$data['attempt_id']` is set **before** the
    `if (!$attempt_id)` fallback, and the view checks emptiness in the wrong order.
14. `student_answers.answered_at` has `ON UPDATE CURRENT_TIMESTAMP` and
    `save_answer()` writes it explicitly on every update.
15. `get_student_summary()` / `get_score_list()` — the "latest attempt per paper"
    correlated sub-query is re-evaluated per row; slow as data grows.

**Correctness / security** — see §13 (IDOR in `updateAccount`, unescaped output,
no CSRF).

**Dead code**
- `FrontController::makekitProducts()` — an entire earlier pagination implementation
  is commented out above the live one.
- `FrontController::addToCart()` — old single-item version commented out.
- `Front_model::questionaires()` — older variant commented out.
- `Front_model::place_order()` has an unused update branch that would leave
  `$order_id` undefined.
- `includes/footer_home.php` — unused legacy footer with undefined variables.
- `assets/fonts/{Reey,icomoon,FontAwesome}.*` and `assets/css/all.min.css` — unused.
- `Base_Controller::get_encrypted_password()` — superseded by the password helper.
- `$this->folder = $_SERVER['DOCUMENT_ROOT'] . "/makekit-web"` — set, never read.
- `assets/images/{as-logo.png, background/footer-pattern.png, email-header.png}`
  are referenced but not present in the repo.

**Style / consistency**
- `$.parseJSON` (removed in jQuery 3) is used in **every** view. Works today only
  because jQuery 3.7.1 kept a deprecation shim. Migrate to `JSON.parse`.
- Submit buttons are routinely left `disabled` after a failed AJAX post
  (checkout, address, edit-account, registration, reset-password).
- Inconsistent method names: `makekitStudentRegistraion` (typo), `load-intitute-circles`
  (typo in the **route**, referenced by the view), `loadInstituteCircles` (correct in PHP),
  `drawinList`, `get_questions_and_answers`, `classeC_teacher`.
- Model returns `false` and `result()` interchangeably; callers must null-check.
- `photo.photo_header` and `page_text` are sometimes escaped (`htmlspecialchars`)
  and sometimes not, within the same file.

---

## 15. How to make common changes

### Add a CMS-driven page
1. Insert a `pages` row (new `page_id` ≥ 28, `status = 0`, `page_type = 0`).
2. Add `$data['pageMain'] = $this->Front_model->fetchPage(<new id>);` in a new
   `FrontController` method, plus `$data['activePage'] = '…'`.
3. Add a route in `application/config/routes.php` (lowercase slug, kebab-case).
4. Copy the view skeleton above into `application/views/<name>.php`.
5. Add the `case` to the `switch` in `application/views/includes/head.php` for the title.
6. Add the nav entry in `includes/header.php` (desktop menu, mobile menu) if it's a
   top-level page.

### Add a product
Insert into `products` (`cate_id`, `name`, `price`, `quantity`, `slug_url`,
`status = 0`, and `minimum_eligiblity_value` if it is an award). Images go into
`photo` with `table = 'products'`, `field_id = pro_id`, `status = 1`, and the three
sized variants on disk. Both the catalog card and the product page pick it up with
no code change.

### Add a category
Insert into `categories` with `status = 0`. Set `show_in_site = 1` for the bottom nav,
`show_as_widget = 1` for the homepage icon row. ⚠ To appear on the homepage icon row
it must ALSO have a key in the `$categoryIcons` map in `application/views/index.php`
(currently only `harkava`, `robotronic`, `games`, `science`; unmapped slugs are
silently skipped). Its `seo_url` becomes the `/product-category/{seo_url}` slug.

### Add an AJAX endpoint
```php
public function myEndpoint() {
    try {
        $x = $this->input->post('x');
        if (!$x) throw new Exception("הודעה בעברית למשתמש");
        $rows = $this->Front_model->get_data_with_conditions_and_joins(
            'table t', ['t.a'], [],
            [['field' => 't.b', 'value' => $x]], 1
        );
        $message = ['status' => 'success', 'data' => $rows];
    } catch (Exception $ex) {
        $message = ['status' => 'error', 'message' => $ex->getMessage()];
    }
    echo json_encode($message);
}
```
Add it to `routes.php`, add a checkbox in `front_model.php` if it mutates data, and
add a section to §6 of this file.

### Add a view variable
Set it in the controller's `$data`, then echo with `<?= html_escape($var) ?>` for
attributes/text (the current code often omits this — don't copy the bad examples).

---

## 16. House rules for this codebase

**Match the existing style** — this is a legacy CI3 codebase, not a greenfield one.
- 2-space indent in controllers/views, 4-space in the model and helpers. Keep whatever
  the surrounding file uses.
- `$this->Front_model->…` — the model property is capitalised.
- `snake_case` for controller methods and model methods; views are plain names.
- User-facing strings are **Hebrew**; code comments and identifiers are English.
- Use `$this->uri->segment(n)`, `$this->input->post/get`, `$this->load->view()`,
  `$this->db` — the CI idioms. Do not introduce a service layer, repository pattern
  or dependency-injection container; there is no autoloader for namespaces beyond the
  `application/base/` hook.
- Prefer extending `get_data_with_conditions_and_joins()` over writing raw SQL. The
  two places that do use raw SQL (`questionaires`, `get_student_summary*`) inject a
  pre-cast `(int)$student_id` / use a `?` placeholder — keep that discipline if you add more.
- The `is_numeric($limit)` trick in `get_data_with_conditions_and_joins` means
  `limit = 0` means "no limit". Don't pass 0 expecting a zero-row result.

**Before you commit**
- There is no test suite, linter or type checker. **Verify by loading the page in
  the browser** (`http://localhost:8081`) and by re-importing the DB if you touched schema.
- If you add/change a route, a page ID, a category slug, a token, a magic number or
  a DB column that this file documents, **update this file in the same commit**.
- Never edit anything under `system/` — upgrade CI3 by replacing the directory, never
  by patching files in it.
- Don't commit DB credentials, SMTP passwords, or `application/config/development/`
  (already gitignored).

---

*Last updated: 2026-09-28 — reflects branch `feature/modifications-28-09-2026`, CI 3.1.13, 61-table DB, Docker stack on 8081/8082/3308. Coin model corrected: see §10.*
