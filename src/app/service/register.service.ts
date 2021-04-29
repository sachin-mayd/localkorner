import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class RegisterService {
  url ="http://localhost/localKorner/localkornerbackend/apis/register"
  constructor(private http:HttpClient,private router:Router) { }
  saveUserData(data:any){
     this.http.post(this.url,data).toPromise().then((data:any)=>{
      alert(data.msg);
      this.router.navigate(['/login']);
  });

  }
}
