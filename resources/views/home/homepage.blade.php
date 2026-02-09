@section('title', 'RegentMarkets')
@include('home.header')


  <!-- ===================== HERO ===================== -->
  <main class="bg-white dark:bg-[#0b1118]">
    <div class="max-w-7xl mx-auto px-6 py-4 lg:py-6">
      <div class="grid grid-cols-1 lg:grid-cols-2 items-center gap-10">
        <!-- Video (left on desktop, top on mobile) -->
        <div class="flex justify-center lg:justify-start">
          <video autoplay loop muted playsinline class="w-full max-w-lg dark:hidden">
            <source src="{{ asset('assets/videos/BBLaptop.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <img src="{{ asset('assets/img/BBLaptopLight.svg') }}" alt="Trading Platform" class="w-full max-w-lg hidden dark:block">
        </div>

        <!-- Text (right on desktop, bottom on mobile) -->
        <div class="lg:-mt-8 lg:pl-6">
          <h1 class="text-4xl md:text-5xl font-extrabold leading-tight text-black dark:text-white">
            Trading is Better<br />
            With <span class="text-[#04b3e1]">RegentMarkets</span>
          </h1>

          <p class="mt-4 text-[15px] leading-7 text-black/80 dark:text-white/80 font-medium">
            Raw spreads. Real time trade signals.<br />
            Round the clock support.
          </p>

          <div class="mt-6 flex flex-wrap items-center gap-4">
            <a href="{{ route('register') }}"
               class="h-12 px-10 inline-flex items-center justify-center font-bold text-sm text-white bg-[#04b3e1] border border-[#04b3e1] hover:bg-[#0390c9]"
               style="border-radius:4px;">
              Create Account
            </a>

            <a href="{{ route('login') }}"
               class="h-12 px-10 inline-flex items-center justify-center font-bold text-sm text-[#04b3e1] dark:text-[#04b3e1] bg-white dark:bg-[#000000] border border-[#04b3e1] dark:border-[#04b3e1] hover:bg-gray-100 dark:hover:bg-[#0b1118]"
               style="border-radius:4px;">
              Login Account
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- ===================== CRYPTO TICKER ===================== -->
  <div class="w-full bg-white dark:bg-[#000000] border-y border-gray-100 dark:border-gray-800 overflow-hidden">
    <div class="ticker-wrapper py-2">
      <div class="ticker-content flex items-center gap-12 animate-ticker whitespace-nowrap">
        <!-- Ticker items -->
        <div class="flex items-center gap-3">
          <span class="w-6 h-6 rounded-full bg-gradient-to-br from-[#9945FF] to-[#14F195] flex items-center justify-center text-white text-[10px] font-bold shadow-sm">S</span>
          <span class="font-bold text-sm text-black dark:text-white">SOLUSDT</span>
          <span class="text-sm font-medium text-black dark:text-white">86.16</span>
          <span class="text-xs font-semibold text-red-500">-1.30 (-1.49%)</span>
        </div>
        <div class="flex items-center gap-3">
          <span class="w-6 h-6 rounded-full bg-gradient-to-br from-[#FF2D55] to-[#FF9500] flex items-center justify-center text-white text-[10px] font-bold shadow-sm">M</span>
          <span class="font-bold text-sm text-black dark:text-white">MANAUSDT</span>
          <span class="text-sm font-medium text-black dark:text-white">0.1042</span>
          <span class="text-xs font-semibold text-green-500">+0.00 (+1.96%)</span>
        </div>
        <div class="flex items-center gap-3">
          <span class="w-6 h-6 rounded-full bg-blue-600 flex items-center justify-center text-white text-[10px] font-bold shadow-sm">€</span>
          <span class="font-bold text-sm text-black dark:text-white">EURUSD</span>
          <span class="text-sm font-medium text-black dark:text-white">1.18141</span>
          <span class="text-xs font-semibold text-green-500">+0.00371 (+0.32%)</span>
        </div>
        <div class="flex items-center gap-3">
          <span class="w-6 h-6 rounded-full bg-orange-500 flex items-center justify-center text-white text-[10px] font-bold shadow-sm">₿</span>
          <span class="font-bold text-sm text-black dark:text-white">BTCUSDT</span>
          <span class="text-sm font-medium text-black dark:text-white">69,064</span>
          <span class="text-xs font-semibold text-red-500">▼</span>
        </div>
        <!-- Duplicate for loop -->
        <div class="flex items-center gap-3">
          <span class="w-6 h-6 rounded-full bg-gradient-to-br from-[#9945FF] to-[#14F195] flex items-center justify-center text-white text-[10px] font-bold shadow-sm">S</span>
          <span class="font-bold text-sm text-black dark:text-white">SOLUSDT</span>
          <span class="text-sm font-medium text-black dark:text-white">86.16</span>
          <span class="text-xs font-semibold text-red-500">-1.30 (-1.49%)</span>
        </div>
        <div class="flex items-center gap-3">
          <span class="w-6 h-6 rounded-full bg-gradient-to-br from-[#FF2D55] to-[#FF9500] flex items-center justify-center text-white text-[10px] font-bold shadow-sm">M</span>
          <span class="font-bold text-sm text-black dark:text-white">MANAUSDT</span>
          <span class="text-sm font-medium text-black dark:text-white">0.1042</span>
          <span class="text-xs font-semibold text-green-500">+0.00 (+1.96%)</span>
        </div>
      </div>
    </div>
  </div>

  <style>
    @keyframes ticker {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }
    .animate-ticker { animation: ticker 25s linear infinite; }
    .ticker-wrapper:hover .animate-ticker { animation-play-state: paused; }
  </style>

  <!-- ===================== LIGHTNING SPEED EXECUTION ===================== -->
  <section class="bg-white dark:bg-[#000000] py-16 lg:py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-4 items-center justify-items-center">
        <!-- Left: Text Content -->
        <div class="text-left">
          <h2 class="text-3xl lg:text-4xl font-black leading-tight text-black dark:text-white">
            Lightning speed<br />
            execution with razor-<br />
            thin spreads
          </h2>

          <p class="mt-6 text-[14px] text-black/60 dark:text-white/60 font-semibold">
            You get the best trading conditions :
          </p>

          <ul class="mt-6 space-y-4">
            <li class="flex items-center gap-4">
              <span class="w-6 h-6 rounded-full bg-[#00A3FF] flex items-center justify-center shadow-sm">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                </svg>
              </span>
              <span class="text-[15px] text-black dark:text-white font-bold">Low Latency</span>
            </li>
            <li class="flex items-center gap-4">
              <span class="w-6 h-6 rounded-full bg-[#00A3FF] flex items-center justify-center shadow-sm">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                </svg>
              </span>
              <span class="text-[15px] text-black dark:text-white font-bold">Spreads from 0.0 pips</span>
            </li>
            <li class="flex items-center gap-4">
              <span class="w-6 h-6 rounded-full bg-[#00A3FF] flex items-center justify-center shadow-sm">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                </svg>
              </span>
              <span class="text-[15px] text-black dark:text-white font-bold">Copy Trading Available</span>
            </li>
          </ul>
        </div>

        <!-- Right: Flowchart Video -->
        <div class="flex justify-center">
          <video autoplay loop muted playsinline class="w-full max-w-md dark:hidden">
            <source src="{{ asset('assets/videos/BBFlowchart.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <img src="{{ asset('assets/img/BBStocks.svg') }}" alt="Stocks Chart" class="w-full max-w-md hidden dark:block">
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== 24/7 CUSTOMER SERVICE ===================== -->
  <section class="bg-[#0052CC] dark:bg-black py-12 lg:py-16 overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-6">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-2 items-center justify-items-center">
        
        <!-- Left: Image -->
        <div class="flex justify-center">
          <img src="{{ asset('assets/img/BBHeadset.webp') }}" 
               alt="Customer Service Support" 
               class="w-full max-w-[280px] lg:max-w-[280px] drop-shadow-2xl relative z-10" />
        </div>

        <!-- Right: Text Content -->
        <div class="text-white relative z-10 text-left">
          <h2 class="text-3xl lg:text-4xl font-extrabold leading-[1.1] tracking-tight">
            Unrivaled 24/7<br />
            Customer Service
          </h2>

          <p class="mt-6 text-base lg:text-base text-white/90 font-medium max-w-xl leading-relaxed">
            Got an issue? We respond under 5 minutes<br />
            on live chat and solve the problem for you.
          </p>

          <ul class="mt-6 space-y-3">
            <li class="flex items-center gap-4">
              <span class="w-6 h-6 flex items-center justify-center rounded-full bg-white/20">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                </svg>
              </span>
              <span class="text-lg font-bold">Contact us anytime, from anywhere</span>
            </li>
            <li class="flex items-center gap-4">
              <span class="w-6 h-6 flex items-center justify-center rounded-full bg-white/20">
                <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                </svg>
              </span>
              <span class="text-lg font-bold">One-to-one trading support for all clients</span>
            </li>
          </ul>
        </div>

      </div>
    </div>

    <!-- Decorative element -->
    <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-white opacity-5 rounded-full blur-[120px] translate-x-1/2 -translate-y-1/2"></div>
  </section>



  <!-- ===================== TRADE INSTRUMENTS ===================== -->
  <section class="bg-white dark:bg-[#000000] py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-5xl font-black mb-4" style="color: var(--background-heading-colour);">Trade Instruments at your Fingertips</h2>
        <p class="text-lg max-w-2xl mx-auto" style="color: var(--background-font-colour);">
          Choose from a range of global markets and trade on extremely tight spreads.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Copy -->
        <!-- Copy -->
        <div class="p-8 rounded-md text-center hover:shadow-xl transition-shadow group h-full flex flex-col items-center" 
             style="background-color: var(--background-colour); border: 1px solid var(--border-colour);">
           <div class="w-16 h-16 mb-6 flex items-center justify-center">
             <img src="{{ asset('assets/img/instrument/BBWorld.svg') }}" alt="Copy Trading" class="w-full h-full object-contain" />
           </div>
           <h3 class="text-2xl font-bold mb-4" style="color: var(--background-heading-colour);">Copy</h3>
           <p class="text-[15px] mb-8 leading-relaxed h-20" style="color: var(--background-font-colour);">
             Copy trading allows you to copy the positions taken by another trader.
           </p>
           <a href="#" class="font-bold hover:underline text-lg mt-auto" style="color: #00A3FF;">Learn More</a>
        </div>

        <!-- Forex -->
        <!-- Forex -->
        <div class="p-8 rounded-md text-center hover:shadow-xl transition-shadow group h-full flex flex-col items-center" 
             style="background-color: var(--background-colour); border: 1px solid var(--border-colour);">
           <div class="w-16 h-16 mb-6 flex items-center justify-center">
             <img src="{{ asset('assets/img/instrument/BBForex.svg') }}" alt="Forex Trading" class="w-full h-full object-contain" />
           </div>
           <h3 class="text-2xl font-bold mb-4" style="color: var(--background-heading-colour);">Forex</h3>
           <p class="text-[15px] mb-8 leading-relaxed h-20" style="color: var(--background-font-colour);">
             Trade currency pairs and be able to implement your own trading strategies with minimum slippage
           </p>
           <a href="#" class="font-bold hover:underline text-lg mt-auto" style="color: #00A3FF;">Learn More</a>
        </div>

        <!-- Crypto -->
        <!-- Crypto -->
        <div class="p-8 rounded-md text-center hover:shadow-xl transition-shadow group h-full flex flex-col items-center" 
             style="background-color: var(--background-colour); border: 1px solid var(--border-colour);">
           <div class="w-16 h-16 mb-6 flex items-center justify-center">
             <img src="{{ asset('assets/img/instrument/BBCrypto.svg') }}" alt="Crypto Trading" class="w-full h-full object-contain" />
           </div>
           <h3 class="text-2xl font-bold mb-4" style="color: var(--background-heading-colour);">Crypto</h3>
           <p class="text-[15px] mb-8 leading-relaxed h-20" style="color: var(--background-font-colour);">
             Buy and sell Bitcoin and other leading crypto currencies with ease on our platform
           </p>
           <a href="#" class="font-bold hover:underline text-lg mt-auto" style="color: #00A3FF;">Learn More</a>
        </div>

         <!-- Stocks -->
         <!-- Stocks -->
        <div class="p-8 rounded-md text-center hover:shadow-xl transition-shadow group h-full flex flex-col items-center" 
             style="background-color: var(--background-colour); border: 1px solid var(--border-colour);">
           <div class="w-16 h-16 mb-6 flex items-center justify-center">
             <img src="{{ asset('assets/img/instrument/BBStocks2.svg') }}" alt="Stocks Trading" class="w-full h-full object-contain" />
           </div>
           <h3 class="text-2xl font-bold mb-4" style="color: var(--background-heading-colour);">Stocks</h3>
           <p class="text-[15px] mb-8 leading-relaxed h-20" style="color: var(--background-font-colour);">
             Stocks, also commonly referred to as shares, are issued by a public corporation and put up for sale.
           </p>
           <a href="#" class="font-bold hover:underline text-lg mt-auto" style="color: #00A3FF;">Learn More</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== 1 ACCOUNT MULTIPLE PRODUCTS ===================== -->
  <section class="py-16 lg:py-24" style="background-color: var(--secondary-background);">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-3xl md:text-5xl font-extrabold mb-6" style="color: var(--secondary-heading-colour);">1 Account Multiple Products</h2>
        <p class="text-lg md:text-xl max-w-3xl mx-auto font-medium leading-relaxed" style="color: var(--secondary-font-colour);">
          Diversify your portfolio with access to products across different<br class="hidden md:block" />
          asset classes. Trade Forex, Indices, Stocks, Crypto and ETFs.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Crypto -->
        <!-- Crypto -->
        <div class="p-8 rounded-2xl transition-colors group relative overflow-hidden text-left h-full flex flex-col" style="background-color: #2680EB;">
           <div class="w-16 h-16 mb-6 flex items-center justify-start">
             <img src="{{ asset('assets/img/products/BBIconCrypto.png') }}" alt="Crypto Trading" class="w-full h-full object-contain" />
           </div>
           <h3 class="text-3xl font-bold text-white mb-4">Crypto</h3>
           <p class="text-white/80 text-[15px] mb-8 leading-relaxed flex-grow font-medium">
             Trade and Mine Bitcoin and Other Leading Crypto Currencies with Decentralized Finance
           </p>
           <div class="mt-auto">
             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
             </svg>
           </div>
        </div>

        <!-- Copy -->
        <!-- Copy -->
        <div class="p-8 rounded-2xl transition-colors group relative overflow-hidden text-left h-full flex flex-col" style="background-color: #2680EB;">
           <div class="w-16 h-16 mb-6 flex items-center justify-start">
             <img src="{{ asset('assets/img/products/BBIconCopy.png') }}" alt="Copy Trading" class="w-full h-full object-contain" />
           </div>
           <h3 class="text-3xl font-bold text-white mb-4">Copy</h3>
           <p class="text-white/80 text-[15px] mb-8 leading-relaxed flex-grow font-medium">
             Copy trading allows you to directly copy the positions taken by another trader. You simply copy everything
           </p>
           <div class="mt-auto">
             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
             </svg>
           </div>
        </div>

        <!-- Forex -->
        <!-- Forex -->
        <div class="p-8 rounded-2xl transition-colors group relative overflow-hidden text-left h-full flex flex-col" style="background-color: #2680EB;">
           <div class="w-16 h-16 mb-6 flex items-center justify-start">
             <img src="{{ asset('assets/img/products/BBIconForex.png') }}" alt="Forex Trading" class="w-full h-full object-contain" />
           </div>
           <h3 class="text-3xl font-bold text-white mb-4">Forex</h3>
           <p class="text-white/80 text-[15px] mb-8 leading-relaxed flex-grow font-medium">
             Trade currency pairs and be able to implement your own trading strategies with minimum slippage
           </p>
           <div class="mt-auto">
             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
             </svg>
           </div>
        </div>

         <!-- Stocks -->
        <!-- Stocks -->
        <div class="p-8 rounded-2xl transition-colors group relative overflow-hidden text-left h-full flex flex-col" style="background-color: #2680EB;">
           <div class="w-16 h-16 mb-6 flex items-center justify-start">
             <img src="{{ asset('assets/img/products/BBIconStocks.png') }}" alt="Stocks Trading" class="w-full h-full object-contain" />
           </div>
           <h3 class="text-3xl font-bold text-white mb-4">Stocks</h3>
           <p class="text-white/80 text-[15px] mb-8 leading-relaxed flex-grow font-medium">
             Stocks, also commonly referred to as shares, are issued by a public company and put up for sale.
           </p>
           <div class="mt-auto">
             <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
               <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
             </svg>
           </div>
        </div>
      </div>
    </div>
  </section>




  <!-- ===================== FAQ ===================== -->
  <section class="py-16 lg:py-24" style="background-color: var(--background-colour);">
    <style>
      .collapsible-header {
        border-bottom: 0px;
        color: var(--primary-font-colour) !important;
        background: var(--primary-background);
        font-size: 1rem; /* Smaller font size */
        cursor: pointer;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        line-height: 1.5;
        padding: 1rem;
        /* Removed border-bottom */
        display: flex;
        align-items: center;
        width: 100%;
        text-align: left;
      }
      .collapsible-header:hover {
        background-color: var(--hover, #dce2e4);
      }
      /* Removed borders for open details */
      details[open] .collapsible-header {
        border-bottom: none;
      }
      details:last-child .collapsible-header {
        border-bottom: none;
      }
      details[open]:last-child .collapsible-header {
        border-bottom: none;
      }
      .faq-arrow {
        margin-right: 1rem;
        transition: transform 0.3s ease;
        width: 20px; /* Smaller arrow */
        height: 20px;
      }
      details[open] .faq-arrow {
        transform: rotate(180deg);
      }
    </style>
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-black mb-4" style="color: var(--background-heading-colour);">FAQs</h2>
      </div>

      <div class="space-y-6"> <!-- Single column stack with gap -->
        
        <!-- Card 1: Trading Questions -->
        <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow" style="background-color: var(--primary-background);">
          
          <!-- Q1 -->
          <details class="group">
            <summary class="collapsible-header">
              <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              What are the fees?
            </summary>
            <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
              We offer competitive spreads and low commissions. Detailed fee structures for each account type can be found on our Trading Conditions page.
            </div>
          </details>

          <!-- Q2 -->
          <details class="group">
            <summary class="collapsible-header">
              <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              How does copy trading work?
            </summary>
            <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
              Copy trading allows you to automatically copy the positions of experienced traders. You can browse through our list of top traders, view their performance history, and choose who to copy.
            </div>
          </details>

          <!-- Q3 -->
          <details class="group">
            <summary class="collapsible-header">
              <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              Who are the trading experts?
            </summary>
            <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
              Our trading experts are vetted professionals with proven track records. You can view detailed statistics on their performance before deciding to follow them.
            </div>
          </details>

          <!-- Q4 -->
          <details class="group">
            <summary class="collapsible-header">
              <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              Do I Need to Install Any Trading Software?
            </summary>
            <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
              No, our platform is web-based and accessible from any browser. We also offer mobile apps for iOS and Android for trading on the go.
            </div>
          </details>

          <!-- Q5 -->
          <details class="group">
            <summary class="collapsible-header">
              <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              What is the recommended amount to start with?
            </summary>
            <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
              You can start with as little as $100. However, we recommend starting with an amount you are comfortable with and that allows for proper risk management.
            </div>
          </details>

        </div>

        <!-- Card 2: Mining Questions -->
        <div class="rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition-shadow" style="background-color: var(--primary-background);">
          
          <!-- Q1 -->
          <details class="group">
            <summary class="collapsible-header">
              <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              Are you mining for yourself?
            </summary>
            <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
              Besides the fact that we ourselves mine with the very same hardware that we offer to our clients, our capital is limited. We believe that Bitcoin and Altcoin mining is one of the best ways to receive Cryptocurrencies, however, we do not want to "put all our eggs in one basket".
            </div>
          </details>

          <!-- Q2 -->
          <details class="group">
            <summary class="collapsible-header">
              <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              What is the maintenance fee?
            </summary>
            <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
              Maintenance fees cover the cost of hardware, electricity, and cooling for mining operations. These are deducted automatically from mining rewards.
            </div>
          </details>

          <!-- Q3 -->
          <details class="group">
            <summary class="collapsible-header">
              <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              How does Bitcoin mining work
            </summary>
            <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
              Bitcoin mining involves solving complex mathematical problems to validate transactions on the blockchain. Miners are rewarded with new Bitcoins for their work.
            </div>
          </details>

          <!-- Q4 -->
          <details class="group">
            <summary class="collapsible-header">
              <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              Where is your mining farm located?
            </summary>
            <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
              Our mining farms are located in regions with low electricity costs and favorable climates for cooling, ensuring maximum efficiency.
            </div>
          </details>

          <!-- Q5 -->
          <details class="group">
            <summary class="collapsible-header">
              <svg class="faq-arrow" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
              Which pools are you using for mining?
            </summary>
            <div class="p-6 pt-0 text-sm leading-relaxed" style="color: var(--background-font-colour);">
              We use a combination of top-tier mining pools to ensure consistent rewards and network stability.
            </div>
          </details>
          
        </div>

      </div>
    </div>
  </section>

  <!-- ===================== TRADING PLANS ===================== -->
  <section class="py-16 lg:py-24" style="background-color: var(--background-colour);">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-5xl md:text-7xl font-black text-black dark:text-white mb-2">Plans</h2>
        <h3 class="text-3xl md:text-4xl font-black text-black dark:text-white">Trading</h3>
      </div>
      
      <style>
        @media (max-width: 768px) {
          .mobile-slide-in {
            animation: slideInBottom 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(50px);
          }
          .mobile-slide-in:nth-child(1) { animation-delay: 0.1s; }
          .mobile-slide-in:nth-child(2) { animation-delay: 0.3s; }
          .mobile-slide-in:nth-child(3) { animation-delay: 0.5s; }
          .mobile-slide-in:nth-child(4) { animation-delay: 0.7s; }
          
          @keyframes slideInBottom {
            from {
              opacity: 0;
              transform: translateY(50px);
            }
            to {
              opacity: 1;
              transform: translateY(0);
            }
          }
        }
      </style>

      <!-- Plans Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <!-- PLATINUM -->
        <div class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
          <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">PLATINUM</div>
          <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$1,000,000.00</div>
          
          <div class="w-full space-y-4 mb-8 text-left text-sm">
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Low Swap Fees</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Leverage up to 1:1000</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Spreads from 0.0 pips</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
          </div>

          <a href="{{ route('register') }}" class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
            FUND TRADING
          </a>
        </div>

        <!-- PREMIUM -->
        <div class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
          <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">PREMIUM</div>
          <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$250,000.00</div>
          
          <div class="w-full space-y-4 mb-8 text-left text-sm">
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Low Swap Fees</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Leverage up to 1:500</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Spreads from 0.4 pips</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
          </div>

          <a href="{{ route('register') }}" class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
            FUND TRADING
          </a>
        </div>

        <!-- GOLD -->
        <div class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
          <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">GOLD</div>
          <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$100,000.00</div>
          
          <div class="w-full space-y-4 mb-8 text-left text-sm">
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Low Swap Fees</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Leverage up to 1:500</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Spreads from 0.8 pips</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
          </div>

          <a href="{{ route('register') }}" class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
            FUND TRADING
          </a>
        </div>

        <!-- SILVER -->
        <div class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
          <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">SILVER</div>
          <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$40,000.00</div>
          
          <div class="w-full space-y-4 mb-8 text-left text-sm">
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>No Swap Fees</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Leverage up to 1:500</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Spreads from 0.8 pips</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
          </div>

          <a href="{{ route('register') }}" class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
            FUND TRADING
          </a>
        </div>

        <!-- BRONZE -->
        <div class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
          <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">BRONZE</div>
          <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$15,000.00</div>
          
          <div class="w-full space-y-4 mb-8 text-left text-sm">
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Leverage up to 1:500</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Spreads from 0.8 pips</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Instant Execution</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
          </div>

          <a href="{{ route('register') }}" class="w-full h-12 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-sm flex items-center justify-center transition-opacity rounded-lg">
            FUND TRADING
          </a>
        </div>

        <!-- MINI -->
        <div class="mobile-slide-in bg-white dark:bg-[#0b1118] p-10 rounded-[32px] shadow-xl border border-gray-100 dark:border-gray-800 flex flex-col items-center text-center">
          <div class="text-gray-400 font-bold uppercase tracking-widest text-sm mb-4">MINI</div>
          <div class="text-[var(--primary-link-colour)] text-3xl md:text-4xl font-black mb-8">$1,000.00</div>
          
          <div class="w-full space-y-4 mb-8 text-left text-sm">
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Leverage up to 1:500</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Spreads from 1.2 pips</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex items-center justify-between text-black dark:text-white font-bold">
              <span>Standard Support</span>
              <svg class="w-6 h-6 text-[var(--primary-link-colour)]" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
            </div>
          </div>

          <a href="{{ route('register') }}" class="w-full h-16 bg-[var(--primary-button)] hover:opacity-90 text-white font-black text-lg flex items-center justify-center transition-opacity rounded-lg">
            FUND TRADING
          </a>
        </div>

      </div>
    </div>
  </section>


 



  <!-- ===================== TESTIMONIALS ===================== -->
  <section class="bg-[#F0F9FF] dark:bg-[#000000] py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <h4 class="text-gray-500 uppercase tracking-widest font-bold text-sm mb-4">TESTIMONIALS</h4>
        <h2 class="text-4xl md:text-5xl font-black text-black dark:text-white mb-6">Words From Clients</h2>
        <p class="text-gray-500 text-lg max-w-2xl mx-auto">
          We provide a investing advantage with client reviews and unbiased editorial research.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-12">
        
        <!-- Jordan Ford -->
        <div class="flex flex-col gap-6">
          <div class="bg-white dark:bg-[#0b1118] p-8 md:p-10 shadow-xl rounded-none border border-gray-100 dark:border-gray-800">
            <p class="text-black dark:text-gray-200 font-medium text-lg leading-relaxed">
              RegentMarkets stands out for its transparency and user-friendly features. I especially like the customizable dashboards and the fact that they don't overload you with gimmicky offers. It's all about performance.
            </p>
          </div>
          <div class="flex items-center gap-4 pl-4">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen" class="w-14 h-14 rounded-full object-cover">
            <div>
              <h4 class="text-xl font-bold text-black dark:text-white">Michael Chen</h4>
            </div>
          </div>
        </div>

        <!-- Laura O Visan -->
        <div class="flex flex-col gap-6">
          <div class="bg-white dark:bg-[#0b1118] p-8 md:p-10 shadow-xl rounded-none border border-gray-100 dark:border-gray-800">
            <p class="text-black dark:text-gray-200 font-medium text-lg leading-relaxed">
              Any issues I had were quickly resolved by the RegentMarkets support team. They're responsive, polite, and genuinely helpful—something that's rare in this industry. The platform itself is intuitive and perfect for active traders.
            </p>
          </div>
          <div class="flex items-center gap-4 pl-4">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Jenkins" class="w-14 h-14 rounded-full object-cover">
            <div>
              <h4 class="text-xl font-bold text-black dark:text-white">Sarah Jenkins</h4>
            </div>
          </div>
        </div>

        <!-- Andrew Barrett -->
        <div class="flex flex-col gap-6">
          <div class="bg-white dark:bg-[#0b1118] p-8 md:p-10 shadow-xl rounded-none border border-gray-100 dark:border-gray-800">
            <p class="text-black dark:text-gray-200 font-medium text-lg leading-relaxed">
              I’ve been using RegentMarkets for the past 8 months, and I couldn’t be happier. The interface is clean and user-friendly, making it easy even for beginners to get started. What really stands out is the fast trade execution and helpful support team. Highly recommended for anyone looking for a reliable trading platform.
            </p>
          </div>
           <div class="flex items-center gap-4 pl-4 mb-6">
            <img src="https://randomuser.me/api/portraits/men/85.jpg" alt="David Rodriguez" class="w-14 h-14 rounded-full object-cover">
            <div>
              <h4 class="text-xl font-bold text-black dark:text-white">David Rodriguez</h4>
            </div>
          </div>
        </div>

        <!-- Ted Kolarov -->
        <div class="flex flex-col gap-6">
          <div class="bg-white dark:bg-[#0b1118] p-8 md:p-10 shadow-xl rounded-none border border-gray-100 dark:border-gray-800">
            <p class="text-black dark:text-gray-200 font-medium text-lg leading-relaxed">
              I was initially cautious, but RegentMarkets proved to be a solid and trustworthy platform. Withdrawals are processed on time, and the range of assets available is impressive. I also appreciate the educational resources—they really helped me improve my trading strategy.
            </p>
          </div>
           <div class="flex items-center gap-4 pl-4 mb-6">
            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="James Wilson" class="w-14 h-14 rounded-full object-cover">
            <div>
              <h4 class="text-xl font-bold text-black dark:text-white">James Wilson</h4>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ===================== LATEST NEWS ===================== -->
  <section class="py-16 lg:py-24" style="background-color: var(--background-colour);">
    <div class="max-w-7xl mx-auto px-6">
      <div class="text-center mb-16">
        <h2 class="text-4xl md:text-5xl font-black text-black dark:text-white uppercase">LATEST NEWS</h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        <!-- News 1 -->
        <div class="bg-white dark:bg-[#0b1118] shadow-xl hover:shadow-2xl transition-shadow group rounded-lg overflow-hidden">
          <div class="h-64 overflow-hidden">
            <img src="{{ asset('assets/img/Office.jpg') }}" alt="Bitcoin" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          </div>
          <div class="p-8">
             <h3 class="text-xl font-bold text-black dark:text-white mb-6 leading-tight">
               Bitcoin (BTC) Was Invented By A Pseudonymous Individual Or Group Named Satoshi Nakamoto In
             </h3>
             <hr class="border-gray-200 dark:border-gray-700 my-6">
             <a href="#" class="inline-block text-[#FF9F00] font-bold text-sm tracking-wider hover:opacity-80 transition-opacity">
               READ MORE
             </a>
          </div>
        </div>

        <!-- News 2 -->
        <div class="bg-white dark:bg-[#0b1118] shadow-xl hover:shadow-2xl transition-shadow group rounded-lg overflow-hidden">
          <div class="h-64 overflow-hidden">
             <img src="{{ asset('assets/img/trading-chart.jpg') }}" alt="Satoshi" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          </div>
          <div class="p-8">
             <h3 class="text-xl font-bold text-black dark:text-white mb-6 leading-tight">
               New Research Suggests Satoshi Nakamoto Lived in London Creating Bitcoin
             </h3>
             <hr class="border-gray-200 dark:border-gray-700 my-6">
             <a href="#" class="inline-block text-[#FF9F00] font-bold text-sm tracking-wider hover:opacity-80 transition-opacity">
               READ MORE
             </a>
          </div>
        </div>

        <!-- News 3 -->
        <div class="bg-white dark:bg-[#0b1118] shadow-xl hover:shadow-2xl transition-shadow group rounded-lg overflow-hidden">
          <div class="h-64 overflow-hidden">
             <img src="{{ asset('assets/img/crypChart.png') }}" alt="Coinbase" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
          </div>
          <div class="p-8">
             <h3 class="text-xl font-bold text-black dark:text-white mb-6 leading-tight">
               Coinbase to Suspend Trading of Binance USD (BUSD)
             </h3>
             <hr class="border-gray-200 dark:border-gray-700 my-6">
             <a href="#" class="inline-block text-[#FF9F00] font-bold text-sm tracking-wider hover:opacity-80 transition-opacity">
               READ MORE
             </a>
          </div>
        </div>

      </div>

      <!-- Second Row (Coinbase) -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
         <div class="bg-white dark:bg-[#0b1118] shadow-xl hover:shadow-2xl transition-shadow group rounded-lg overflow-hidden">
           <div class="h-64 overflow-hidden">
              <img src="{{ asset('assets/img/testimonies/news-coinbase.jpg') }}" alt="Coinbase" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
           </div>
           <div class="p-8">
              <h3 class="text-xl font-bold text-black dark:text-white mb-6 leading-tight">
                Coinbase Launches Voter Registration Tool Ahead of November Elections
              </h3>
              <hr class="border-gray-200 dark:border-gray-700 my-6">
              <a href="#" class="inline-block text-[#FF9F00] font-bold text-sm tracking-wider hover:opacity-80 transition-opacity">
                READ MORE
              </a>
           </div>
         </div>
      </div>

    </div>
  </section>

  <!-- ===================== GET STARTED ===================== -->
  <section class="relative py-24 overflow-hidden bg-[#0052CC]">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
      <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
      </svg>
    </div>
    
    <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
      <h2 class="text-4xl md:text-6xl font-black text-white mb-8 leading-tight">
        Get Started! Sign up and <br/>
        Access the Global Markets in <br/>
        less than 3 minutes
      </h2>
      
      <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
        <a href="{{ route('register') }}" class="w-full sm:w-auto h-16 px-12 bg-[#00A3FF] hover:bg-[#0090E0] text-white rounded-none font-bold text-lg flex items-center justify-center transition-colors shadow-lg">
          Signup Now
        </a>
        <a href="{{ route('login') }}" class="w-full sm:w-auto h-16 px-12 border-2 border-white text-white rounded-none font-bold text-lg flex items-center justify-center hover:bg-white/10 transition-colors">
          Login Now
        </a>
      </div>
    </div>
  </section>


@include('home.footer')
