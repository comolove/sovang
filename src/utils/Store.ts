import { ImgPath, BaseResImgObj } from "./";

export default class Store extends BaseResImgObj {
  public storeName = "";
  public link = "";
  public imgList: ImgPath[] = [];
}
