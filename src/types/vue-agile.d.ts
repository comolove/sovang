declare module "vue-agile" {
  import Vue, { PluginObject } from "vue";

  const VueAgilePlugin: PluginObject<{}>;
  export default VueAgilePlugin;
  // export const VueAgile: Vue;

  class VueAgile extends Vue {}
  export { VueAgile };
}
