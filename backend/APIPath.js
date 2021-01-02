//const API_URL = 'http://192.168.5.187/0161/student/screen/api/';
// const API_URL = "http://localhost/leave/backend/";
const API_URL = "http://localhost/leave/backend/";
// const API_URL = "http://localhost/tee/pasaduweb/backend/";

export class APIPath {
    constructor() {}

    getBaseUrl() {
        return API_URL;
    }
}