import { Injectable } from '@angular/core';
import { HttpHeaders } from '@angular/common/http';
@Injectable({
  providedIn: 'root'
})
export class TaskService {
   headers :Headers = new Headers();
   options:any;
  constructor() {
    let headers: HttpHeaders = new HttpHeaders();
    headers = headers.append('enctype', 'multipart/form-data');
    headers = headers.append('Content-Type', 'application/json');
    headers = headers.append('X-Requested-With', 'XMLHttpRequest');
    // this.options = new RequestOptions({headers:this.headers});
   }
}
