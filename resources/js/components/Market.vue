<script setup>
  import { ref, onMounted, computed } from 'vue';
  import SectionHeader from './SectionHeader.vue';

  // Reference to the container
  const container = ref(null);

  // Stock options
  const stockOptions = [
    { name: 'Apple', symbol: 'NASDAQ:AAPL' },
    { name: 'Tesla', symbol: 'NASDAQ:TSLA' },
    { name: 'Microsoft', symbol: 'NASDAQ:MSFT' }
  ];

  // Current selected symbol
  const currentSymbol = ref('NASDAQ:AAPL');

  // Last updated timestamp
  const lastUpdated = computed(() => new Date().toLocaleString());

  // Function to change stock symbol
  const changeSymbol = (symbol) => {
    currentSymbol.value = symbol;

    // Remove existing script if any
    const existingScript = container.value.querySelector('script');
    if (existingScript) {
      existingScript.remove();
    }

    // Create new TradingView widget script
    const script = document.createElement("script");
    script.src = "https://s3.tradingview.com/external-embedding/embed-widget-advanced-chart.js";
    script.type = "text/javascript";
    script.async = true;
    script.innerHTML = JSON.stringify({
      "autosize": true,
      "symbol": symbol,
      "interval": "D",
      "timezone": "Etc/UTC",
      "theme": "dark",
      "style": "1",
      "locale": "en",
      "allow_symbol_change": true,
      "calendar": false,
      "support_host": "https://www.tradingview.com"
    });

    if (container.value) {
      container.value.replaceChildren(script);
    }
  };

  // Initial mount
  onMounted(() => {
    changeSymbol(currentSymbol.value);
  });
  </script>


<template>

    <div id="market" class="min-h-screen">

        <SectionHeader>
            <template #title>
                Explore the <span class="text-yellow-400">Markets</span>
            </template>
            <template #description>
                Stay ahead with real-time access to global markets. Analyze trends, track your favorite assets, and make informed trading decisions with our intuitive tools and live data streams. Start exploring opportunities across stocks, forex, commodities, and more.
            </template>
        </SectionHeader>

      <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col gap-6 sm:flex-row justify-between items-center bg-white/20 rounded-t-md">
        <div class="flex items-center space-x-4">
          <div class="bg-yellow-400 p-2 rounded-full">
            <i class="fa-solid fa-chart-line text-blue-900 text-2xl"></i>
          </div>
          <div>
            <h3 class="text-yellow-400 text-xl font-bold">Market Overview</h3>
            <p class="text-sm text-gray-300">Real-time stock performance</p>
          </div>
        </div>
        <div class="flex space-x-2">
          <button
            v-for="stock in stockOptions"
            :key="stock.symbol"
            @click="changeSymbol(stock.symbol)"
            :class="[
              'px-3 py-1 rounded-md text-sm transition-all duration-300',
              currentSymbol === stock.symbol
                ? 'bg-yellow-400 text-blue-900'
                : 'text-white hover:bg-white/20'
            ]"
          >
            {{ stock.name }}
          </button>
        </div>
      </div>

      <div
        ref="container"
        class="tradingview-widget-container min-h-[500px] max-w-7xl mx-auto"
      >
        <div
          class="tradingview-widget-container__widget"
        ></div>
      </div>

      <div class="max-w-7xl mx-auto px-6 py-4 bg-white/10 flex justify-between items-center rounded-b-md shadow-lg text-xs sm:text-base">
        <div class="flex items-center space-x-3">
          <i class="fa-solid fa-clock text-yellow-400"></i>
          <span class="text-white">Last Updated : {{ lastUpdated }}</span>
        </div>
        <span
          class="text-yellow-400 hover:underline transition-colors"
        >
          Powered by TradeNow
        </span>
      </div>

    </div>
  </template>

<style scoped>

.tradingview-widget-container {
    height: 700px !important;
}

</style>
