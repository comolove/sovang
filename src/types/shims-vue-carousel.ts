declare module "vue-carousel" {
  class Slide extends Vue {}
  class Carousel extends Vue {
    public currentPage: number;
    public goToPage(id: number) : void;
  }
  export { Slide, Carousel };
}
