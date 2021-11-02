import { boot } from 'quasar/wrappers'

const team = []

export default boot(({ app }) => {
  app.config.globalProperties.$team = team
  // ^ ^ ^ this will allow you to use this.$api (for Vue Options API form)
  //       so you can easily perform requests against your app's API
})

export { team }
