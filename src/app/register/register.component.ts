import { Component, OnInit } from '@angular/core';
import { RegisterService } from '../service/register.service';
import { FormControl,FormGroup } from '@angular/forms'

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  saveUser = new FormGroup({
    fname : new FormControl(''),
    lname : new FormControl(''),
    email : new FormControl(''),
    phone : new FormControl(''),
    password : new FormControl(''),
    cpass : new FormControl('')
    });

  constructor(private registerService:RegisterService) { }
  addUser()
  {
    
    return this.registerService.saveUserData(this.saveUser.value);
  }


  ngOnInit(): void {
  }
 
  

}
