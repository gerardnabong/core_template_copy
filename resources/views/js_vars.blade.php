<script>
    const JS_VARS = {};

    JS_VARS.portfolio = JSON.parse('{!!App\JSVars::getPortfolio()!!}');

    window.JS_VARS = JS_VARS;
</script>
