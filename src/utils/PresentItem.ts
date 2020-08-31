import ImgPath from "./ImgPath";

export default class PresentItem {
  public index = -1;
  public title = "";
  public desc = "";
  public popupTitle = "";
  public body = "";
  public thumbImg: ImgPath = new ImgPath();
  public bodyImg: ImgPath = new ImgPath();
}
