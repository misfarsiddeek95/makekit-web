<ul class="nav flex-column user-sidebar-menu">
    <li class="nav-item"><a class="nav-link <?=$activeUserPage == 'MY_ACCOUNT' ? 'active' : '' ?>" href="<?=base_url('my-account/');?>">לוח בקרה</a></li>
    <li class="nav-item"><a class="nav-link <?=$activeUserPage == 'MY_ORDERS' ? 'active' : '' ?>" href="<?=base_url('my-account/orders/');?>">הזמנות</a></li>
    <li class="nav-item"><a class="nav-link <?=$activeUserPage == 'MY_DOWNLOADS' ? 'active' : '' ?>" href="<?=base_url('my-account/downloads/');?>">הורדות</a></li>
    <li class="nav-item"><a class="nav-link <?=$activeUserPage == 'MY_ADDRESS' ? 'active' : '' ?>" href="<?=base_url('my-account/edit-address/');?>">כתובות</a></li>
    <li class="nav-item"><a class="nav-link <?=$activeUserPage == 'EDIT_ACCOUNT' ? 'active' : '' ?>" href="<?=base_url('my-account/edit-account/');?>">פרטי חשבון</a></li>
    <li class="nav-item"><a class="nav-link" href="<?=base_url('logout');?>">התנתקות</a></li>
    <li class="nav-item"><a class="nav-link <?=$activeUserPage == 'MAKEKIT_QUESTIONAIRE' ? 'active' : '' ?>" href="<?=base_url('my-account/makekit-questionnaires');?>">שאלונים (Makekit)</a></li>
    <li class="nav-item"><a class="nav-link <?=$activeUserPage == 'MEDALIAN_QUESTIONAIRE' ? 'active' : '' ?>" href="<?=base_url('my-account/medalian-questionnaires');?>">שאלונים (Medalian)</a></li>
</ul>