@include('user.layouts.header')

<style>
    .trade-detail-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 0 12px;
    }

    .trade-detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 20px;
        border: 1px solid var(--border-color);
    }

    .trade-detail-row:nth-child(odd) {
        background-color: var(--card-bg);
    }

    .trade-detail-row:nth-child(even) {
        background-color: var(--input-bg);
    }

    .trade-detail-row:first-child {
        border-radius: 12px 12px 0 0;
    }

    .trade-detail-row:last-child {
        border-radius: 0 0 12px 12px;
    }

    .trade-detail-label {
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-color);
    }

    .trade-detail-value {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--heading-color);
        text-align: right;
    }

    .trade-chart-container {
        margin-top: 16px;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        background-color: var(--card-bg);
    }

    .trade-chart-symbol {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--heading-color);
        padding: 12px 20px 0;
    }
</style>

<div class="main-content" style="padding-bottom: 100px;">
    <div class="trade-detail-container mt-3">

        <!-- Trade Info Rows -->
        <div class="trade-detail-row">
            <span class="trade-detail-label">STATUS</span>
            <span class="trade-detail-value">{{ strtoupper($trade->status) }}</span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">PROFIT</span>
            <span class="trade-detail-value {{ $trade->profit >= 0 ? 'text-success' : 'text-danger' }}">
                {{ $trade->formattedProfit }}
            </span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">TYPE</span>
            <span class="trade-detail-value">{{ strtoupper($trade->direction ?? 'N/A') }}</span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">SYMBOL</span>
            <span class="trade-detail-value">{{ strtoupper($trade->symbol) }}</span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">OPENING PRICE</span>
            <span class="trade-detail-value">{{ $trade->formattedEntryPrice }}</span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">AMOUNT</span>
            <span class="trade-detail-value">{{ number_format($trade->amount, 4) }}</span>
        </div>

        <div class="trade-detail-row">
            <span class="trade-detail-label">LEVERAGE</span>
            <span class="trade-detail-value">{{ $trade->leverage ?? 25 }}</span>
        </div>

        <!-- TradingView Chart -->
        <div class="trade-chart-container">
            <div class="trade-chart-symbol">{{ strtoupper($trade->symbol) }}</div>
            <div id="tradingview-chart" style="height: 350px;"></div>
        </div>
    </div>
</div>

@include('user.layouts.footer')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const isDark = document.documentElement.classList.contains('dark');
        const symbol = '{{ strtoupper($trade->symbol) }}';

        // Map symbol to TradingView format
        let tvSymbol = symbol;
        const forexPairs = ['AUDUSD','EURUSD','GBPUSD','USDJPY','USDCAD','USDCHF','NZDUSD','EURJPY',
            'EURGBP','GBPJPY','AUDJPY','CADJPY','CHFZAR','AUDCAD','AUDCHF','AUDNZD',
            'AUDBRL','EURBRL','EURCAD','EURCHF','EURAUD','GBPAUD','GBPCAD','GBPCHF','USDZAR'];
        const cryptos = ['BTCUSD','ETHUSD','XRPUSD','SOLUSD','BNBUSD','ADAUSD','DOGEUSD','TRXUSD',
            'DOTUSD','LINKUSD','MATICUSD','AVAXUSD','LTCUSD','ATOMUSD','UNIUSD','XLMUSD',
            'ALGOUSD','NEARUSD','FILUSD','AAVEUSD','APTUSD','ARBUSD','OPUSD','MKRUSD',
            'INJUSD','RNDRUSD','SUIUSD','SHIBUSD','PEPEUSD','TONUSD'];

        if (forexPairs.includes(symbol)) {
            tvSymbol = 'FX:' + symbol;
        } else if (cryptos.includes(symbol)) {
            tvSymbol = 'CRYPTO:' + symbol;
        } else {
            tvSymbol = 'NASDAQ:' + symbol;
        }

        new TradingView.widget({
            "container_id": "tradingview-chart",
            "autosize": true,
            "symbol": tvSymbol,
            "interval": "60",
            "timezone": "Etc/UTC",
            "theme": isDark ? "dark" : "light",
            "style": "3",
            "locale": "en",
            "toolbar_bg": isDark ? "#1a1f2b" : "#ffffff",
            "enable_publishing": false,
            "hide_top_toolbar": true,
            "hide_legend": true,
            "save_image": false,
            "backgroundColor": isDark ? "#1a1f2b" : "#ffffff",
            "gridColor": isDark ? "#2d3748" : "#f0f0f0",
        });

        // Listen for theme changes
        document.addEventListener('themeChanged', function () {
            const nowDark = document.documentElement.classList.contains('dark');
            document.getElementById('tradingview-chart').innerHTML = '';
            new TradingView.widget({
                "container_id": "tradingview-chart",
                "autosize": true,
                "symbol": tvSymbol,
                "interval": "60",
                "timezone": "Etc/UTC",
                "theme": nowDark ? "dark" : "light",
                "style": "3",
                "locale": "en",
                "toolbar_bg": nowDark ? "#1a1f2b" : "#ffffff",
                "enable_publishing": false,
                "hide_top_toolbar": true,
                "hide_legend": true,
                "save_image": false,
                "backgroundColor": nowDark ? "#1a1f2b" : "#ffffff",
                "gridColor": nowDark ? "#2d3748" : "#f0f0f0",
            });
        });
    });
</script>
<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>