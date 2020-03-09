<script>
    if (typeof jsVars === 'undefined'){
        jsVars = {};
    }

    jsVars.portfolio = JSON.parse('{!!App\JsVars::getPortfolio()!!}');

    window.JS_VARS = jsVars;
</script>
