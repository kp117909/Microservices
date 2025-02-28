import { createApp } from 'vue';

// Vuetify
import '@mdi/font/css/materialdesignicons.css';
import 'vuetify/styles';
import { createVuetify } from 'vuetify';
import router from './router';
import * as components from 'vuetify/components';  // Importuj konkretne komponenty
import * as directives from 'vuetify/directives'
// Components
import App from './components/App.vue';

const vuetify = createVuetify({
  components,
  directives
});

createApp(App)
  .use(router)
  .use(vuetify)  // Upewnij się, że Vuetify jest dodane do aplikacji
  .mount('#app');
