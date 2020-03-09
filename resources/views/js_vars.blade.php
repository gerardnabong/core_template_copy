<script>
    let jsVars = {};

    jsVars.portfolio = JSON.parse('{!!App\JSVars::getPortfolio()!!}');

    window.JS_VARS = jsVars;
</script>
