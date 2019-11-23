import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)


import home from '../pages/home.vue'
import about from '../pages/about.vue'
import registration from '../pages/registration.vue'
import login from '../pages/login.vue'
import user from '../pages/profile.vue'
import add_book from '../pages/add_book.vue'
import add_category from '../pages/add_category.vue'
import all_category from '../pages/all_category.vue'
import single_category from '../pages/single_category.vue'
import single_author from '../pages/single_author.vue'
import all_author from '../pages/all_author.vue'
import add_cart from '../pages/add_cart.vue'
import all_book from '../pages/all_book.vue'
import shipping_page from '../pages/shipping_page.vue'
import confirm_order from '../pages/confirm_order.vue'
import all_order from '../pages/all_order.vue'





let Admin = ['Admin'];


export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: home,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'Home',
      }

    },
    {
      path: '/shipping_page',
      name: 'shipping_page',
      component: shipping_page,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'shipping_page',
      }

    },
    {
      path: '/confirm_order/:id',
      name: 'confirm_order',
      component: confirm_order,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'confirm_order',
      }

    },
    {
      path: '/all_order',
      name: 'all_order',
      component: all_order,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'all_order',
      }

    },
    
    {
      path: '/add_book',
      name: 'add_book',
      component: add_book,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'Add A Book',
      }

    },
    {
      path: '/add_cart',
      name: 'add_cart',
      component: add_cart,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'Cart',
      }

    },
    {
      path: '/all_category',
      name: 'all_category',
      component: all_category,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'All Categories',
      }

    },
    {
      path: '/all_category/:id',
      name: 'single_category',
      component: single_category,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'All books of Category',
      }

    },
    {
      path: '/all_author/:id',
      name: 'single_author',
      component: single_author,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'All books of Author',
      }

    },
    {
      path: '/all_author',
      name: 'all_author',
      component: all_author,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'All Authors ',
      }

    },
    {
      path: '/all_book/:id',
      name: 'all_book',
      component: all_book,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'all_book',
      }

    },
    
    {
      path: '/add_category',
      name: 'add_category',
      component: add_category,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'Add A Category',
      }

    },
    {
      path: '/user/:id',
      name: 'user',
      component: user,
      meta: {
         // guest: true,
         // allowedUserType: ['All'],
          title: 'user',
      }

    },
    {
        path: '/about',
        name: 'about',
        component: about,
        meta: {
           // guest: true,
           // allowedUserType: ['All'],
            title: 'About',
        }
  
      },
      {
        path: '/registration',
        name: 'registration',
        component: registration,
        meta: {
           // guest: true,
           // allowedUserType: ['All'],
            title: 'registration',
        }
  
      },
      {
        path: '/login',
        name: 'login',
        component: login,
        meta: {
           // guest: true,
           // allowedUserType: ['All'],
            title: 'login',
        }
  
      }
  ],

});