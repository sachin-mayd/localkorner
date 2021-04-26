import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class RegisterService {
  url ="http://localhost/localKorner/localkornerbackend/apis/register"
  constructor(private http:HttpClient) { }
  saveUserData(data:any){
    let rdta = this.http.post(this.url,data).subscribe((res) => {
      console.log(res);
  });

  }
}
