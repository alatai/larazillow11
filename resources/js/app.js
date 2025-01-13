import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { ZiggyVue } from 'ziggy'
import '../css/app.css'

import MainLayout from '@/Layouts/MainLayout.vue'

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    const page = pages[`./Pages/${name}.vue`]
    // 使用inertia默认布局，适用于具有相同布局的页面
    // 可以先检查这个页面是否有特定布局，否则使用提供的布局
    page.default.layout = page.default.layout || MainLayout
    return page
  },
  setup({ el, App, props, plugin }) {
    // h:渲染函数
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(ZiggyVue)
      .mount(el)
  },
})

/**
 * SPA，意味着不需要再服务器上重新生成整个页面
 * 所以整个应用看起来都是用JavaScript创建的，
 * 它的行为就像一个真正的桌面应用程序
 *
 * 当你访问链接时，不是引导到一个不同的地址并在服务器上生成一个新的页面
 * inertia只确保获取必要的数据，然后在幕后确保替换所有数据、视图
 *
 * this关键字取决于函数是如何被调用
 *
 * async、await关键字
 * async函数创建了promise，作为promise函数将立刻返回
 * 但这并不意味着他们立刻停止工作，这只是意味着这些函数在后台工作
 * 当他们准备好时，会返回一些值
 * await将确保我们等待这个异步函数返回它的值
 */
