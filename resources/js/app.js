import './bootstrap';
import '../css/app.css';
import '../../public/js/main.js'

import { createApp } from 'vue'
// import the root component App from a single-file component.
import App from './Pages/App.vue'

const app = createApp(App)
app.mount('#app')
