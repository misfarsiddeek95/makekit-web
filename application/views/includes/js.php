<!-- Bootstrap JS for toggler functionality -->
<script src="<?=base_url()?>assets/js/bootstrap.bundle.min.js"></script>
<script src="<?=base_url()?>assets/js/jquery-3.7.1.min.js"></script>
<script src="<?=base_url()?>assets/js/main.js"></script>

<script>
    function formatCurrency(amount, currencySymbol = "$") {
        // Ensure the value is a number and fix floating point issues
        let fixedAmount = Number(amount).toFixed(2);
        
        // Add thousands separators
        let parts = fixedAmount.split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        // Return with currency symbol
        return currencySymbol + parts.join(".");
    }

</script>