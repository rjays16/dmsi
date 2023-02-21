import SiteLayout from './components/layouts/pcr_site/SiteLayout.vue'
import SiteHome from './components/modules/pcr_site/Home.vue'
import SiteBlog from './components/modules/pcr_site/Announcement.vue'
import SiteBlogPost from './components/modules/pcr_site/AnnouncementPost.vue'
import SiteLogin from './components/modules/pcr_site/Login.vue'
import SiteApplication from './components/modules/pcr_site/Apply.vue'
import SiteApplicationProfile from './components/modules/pcr_site/Profile.vue'
import SiteApplicationThanks from './components/modules/pcr_site/ThankYou.vue'
import SiteElection from './components/modules/pcr_site/Election.vue'
import SiteElectionThanks from './components/modules/pcr_site/ElectionThankYou.vue'

import PrivacyPolicy from './components/modules/pcr_site/Privacy.vue'
import TermsAndCond from './components/modules/pcr_site/Terms.vue'


import AdminLayout from './components/layouts/pcr_admin/AdminLayout.vue'
import AdminHome from './components/modules/pcr_admin/Home.vue'
import AdminLogin from './components/modules/pcr_admin/Login.vue'

import PCRMiniSessions from './components/modules/pcr_site/MiniSessions.vue'
import PCRMiniSessionsVid from './components/modules/pcr_site/MiniSessionsVid.vue'

// Routes
const routes = [
  {
    path: '/',
	  component: SiteLayout,
    beforeEnter: (to, from, next) => {
		document.body.className += ' pcr-site-layout'
		next()
	  },  
    children: [
      {
        path: '',
        component: SiteHome,
      },
      {
        path: '/announcement',
        component: SiteBlog,
      },
      {
        path: '/announcement/post',
        component: SiteBlogPost,
      },
      {
        path: '/login',
        component: SiteLogin,
      },
      {
        path: '/privacy-policy',
        component: PrivacyPolicy,
      },
      {
        path: '/terms-and-conditions',
        component: TermsAndCond,
      },      
      {
        path: '/apply',
        component: SiteApplication,
      },
      {
        path: '/profile',
        component: SiteApplicationProfile,
      },
      {
        path: '/apply/thank-you',
        component: SiteApplicationThanks,
      },
      {
      path: '/election',
        component: SiteElection,
      },,
      {
      path: '/election/thank-you',
        component: SiteElectionThanks,
      },
      {
        path: '/mini-sessions',
        component: PCRMiniSessions,
      },
      {
        path: '/mini-sessions-details',
        component: PCRMiniSessions,
      }      
    ],
  },  
  {
    path: '/admin',
    component: SiteLayout,
    beforeEnter: (to, from, next) => {
      document.body.className += ' admin-login'
      next()
    },    
    children: [
      {
        path: '',
        component: AdminLogin,
      },
    ],
  }
]

export default routes
