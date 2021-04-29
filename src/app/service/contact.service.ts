import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {Router} from '@angular/router';
@Injectable({
  providedIn: 'root'
})
export class ContactService {
  url ="http://192.168.1.52:8080/localKorner/localkornerbackend/apis/contact-us"
  
  constructor(private http:HttpClient,private router: Router) { }
  saveContactUs(data:any){
    this.http.post(this.url,data).toPromise().then((data:any)=>{
      // console.log(data);
      // console.log(data.msg);
        alert(data.msg);
        // this.router.navigate(['/login']);
    })
  }
}
