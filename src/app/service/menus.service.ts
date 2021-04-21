import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MenusService {

  constructor(private http:HttpClient) { }
  getMenudata(){
    let server_url = environment.base_url;
    return this.http.get(server_url + 'menu-list');
  }
}
