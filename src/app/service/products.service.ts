import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
@Injectable({
  providedIn: 'root'
})
export class ProductsService {
  url ="http://192.168.1.52:8080/localKorner/localkornerbackend/apis/";
  productlist:any;
  constructor(private http:HttpClient) { }
  getBestSeller(){
    return this.http.get(this.url+'best-seller-product')
  }
}
