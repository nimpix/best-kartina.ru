    (function (d, w) {
        w._admitadPixel = {
            response_type: 'img',     // 'script' or 'img'. Default: 'img'
            action_code: '1',
            campaign_code: '530976f02a'
        };
        w._admitadPositions = w._admitadPositions || [];
        w._admitadPositions.push({
            uid: 'e1d3161932e31cf9467f49ae199d1e55',
            tariff_code: '1',
            order_id: '100',
            position_id: '1',
            currency_code: 'RUB',
            position_count: '1',
            price: '1000',
            quantity: '1',
            product_id: '',
            payment_type: 'sale'
        });
        var id = '_admitad-pixel';
        if (d.getElementById(id)) { return; }
        var s = d.createElement('script');
        s.id = id;
        var r = (new Date).getTime();
        var protocol = (d.location.protocol === 'https:' ? 'https:' : 'http:');
        s.src = protocol + '//cdn.asbmit.com/static/js/npixel.js?r=' + r;
        var head = d.getElementsByTagName('head')[0];
        head.appendChild(s);
    })(document, window)