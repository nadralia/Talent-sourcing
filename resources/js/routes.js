import Login from './Pages/Auth/Login.vue'
import Tasks from './Pages/Tasks/Index.vue'
import Talents from './Pages/Talents/Index.vue'
import Clients from './Pages/Clients/Index.vue'
import Reports from './Pages/Reports/Index.vue'
import Calendar from './Pages/Calendar/Index.vue'
import Recruiters from './Pages/Recruiters/Index.vue'
import ProfileUpdateLogin from './Pages/TalentProfileUpdate/Login'
import ProfileUpdateSkills from './Pages/TalentProfileUpdate/Skills'
import ProfileUpdateResume from './Pages/TalentProfileUpdate/Resume'
import ProfileUpdateLayout from './Pages/TalentProfileUpdate/Index'
import ProfileUpdateProfile from './Pages/TalentProfileUpdate/Profile'
import ProfileUpdateEducation from './Pages/TalentProfileUpdate/Education'
import ProfileUpdateExperience from './Pages/TalentProfileUpdate/Experience'
import ProfileUpdateLanguages from './Pages/TalentProfileUpdate/Languages'
import ProfileUpdateCultureFit from './Pages/TalentProfileUpdate/CultureFit'
import ProfileUpdateFinish from './Pages/TalentProfileUpdate/Finish'
import ComingSoon from './Pages/ComingSoon'

export default [
    { path: '/', component: ComingSoon}, // coming soon page
    // { path: '/', name: 'dashboard', component: Dashboard},
    { path: '/login', name: 'login', component: Login},
    { path: '/tasks', name: 'tasks', component: Tasks},
    { path: '/talents', name: 'talents', component: Talents},
    { path: '/clients', name: 'clients', component: Clients},
    { path: '/recruiters', name: 'recruiters', component: Recruiters},
    { path: '/reports', name: 'reports', component: Reports},
    { path: '/calendar', name: 'calendar', component: Calendar},

    { path: '/update-profile/login', name: 'update-profile.login', component: ProfileUpdateLogin},
    { 
        path: '/update-profile', 
        name: 'update-profile', 
        component: ProfileUpdateLayout, 
        children: [
            {
                path: '',
                name: 'update-profile.resume',
                component: ProfileUpdateResume
            },
            {
                path: 'profile',
                name: 'update-profile.profile',
                component: ProfileUpdateProfile
            },
            {
                path: 'languages',
                name: 'update-profile.languages',
                component: ProfileUpdateLanguages
            },
            {
                path: 'education',
                name: 'update-profile.education',
                component: ProfileUpdateEducation
            },
            {
                path: 'skills',
                name: 'update-profile.skills',
                component: ProfileUpdateSkills
            },
            {
                path: 'experience',
                name: 'update-profile.experience',
                component: ProfileUpdateExperience
            },
            {
                path: 'culture-fit',
                name: 'update-profile.culturefit',
                component: ProfileUpdateCultureFit
            },

            {
                path: 'finish',
                name: 'update-profile.finish',
                component: ProfileUpdateFinish
            },
        ],
        beforeEnter: (to, from, next) => {
            const user = JSON.parse(localStorage.getItem("_talent"));

            if (to.name !== "update-profile.login" && !user?.token) {
                localStorage.setItem("route.intended", to.name);
                next({ name: "update-profile.login" });
            } else {
                window.axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${user.token}`;
                localStorage.removeItem("route.intended");
                next();
            }
        }
    },
];
