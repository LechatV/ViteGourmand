export default class Route {
    constructor(url, title, pathHtml, authorizedRoles = [], pathJS = "") {
      this.url = url;
      this.title = title;
      this.pathHtml = pathHtml;
      this.pathJS = pathJS;
      this.authorizedRoles = authorizedRoles;
    }
}