<div id="cookieWrapper" class="bg-dark text-white w-100 py-3 text-center">
<div class="js-cookie-consent d-inline  cookie-consent">

    <span class="cookie-consent__message">
        <?php echo trans('cookieConsent::texts.message'); ?>

    </span>

    <button onclick="$('#cookieWrapper').remove()" class="js-cookie-consent-agree text-dark btn btn-light cookie-consent__agree">
        <?php echo e(trans('cookieConsent::texts.agree')); ?>

    </button>

</div>
</div>
