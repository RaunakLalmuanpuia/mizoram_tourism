install vue
config app.js ..view ...web route..etc
install router

VUE Installation
1. composer require laravel/ui
2. php artisan ui vue
3. npm install & npm run dev

4. npm install vue-router
5. npm install --save vue@next && npm install --save-dev vue-loader@next
6. npm install vue-router@next --save
7. config routes/web.php 
Route::get('/{any}', function () {
    return view('welcome');
})->where('any','.*');
8. app.js
import {createApp} from 'vue'
require('./bootstrap')
import App from './App.vue'
import router from './router'
const app = createApp(App)
 app.use(router)
app.mount('#app')
9. create App.vue

10. welcome.blade.php
the arrange ment of js can cause major problem
       <div id="app">   <example-component/> </div>


 11. npm install axios

------------------
PULL THAR IN
1. composer update
2. npm install
3. npm run dev