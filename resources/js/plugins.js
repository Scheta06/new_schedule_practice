import { defineAsyncComponent } from 'vue'

export default {
    install(app) {
        app.component('TheHeader', defineAsyncComponent(() => import('./Components/TheHeader.vue')))
        app.component('Welcome', defineAsyncComponent(() => import('./Components/Welcome.vue')))
        app.component('Input', defineAsyncComponent(() => import('@/Components/Input.vue')))
    }
}
