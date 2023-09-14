import { createRouter, createWebHistory } from 'vue-router'
import Main from '../views/layouts/Main.vue';

const Home = () => import('../views/Home.vue')
const About = () => import('../views/About.vue')

const routes = [
  {
    path: '/',
    component: Main,
    children: [
      {
        path: '',
        name: 'Home',
        component: Home
      },
      {
        path: 'about',
        name: 'About',
        component: About
      }
    ]
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

router.beforeEach((to, from, next) => {
  const publicPages = ['/login', '/register', '/'];
  const authRequired = !publicPages.includes(to.path);
  const loggedIn = localStorage.getItem('user')
  if (authRequired && !loggedIn) {
    next('/login');
  } else {
    next();
  }
})

export default router
