import { Component, OnInit } from '@angular/core';
import { RegisterService } from '../service/register.service';
import { FormControl,FormGroup,Validators,FormBuilder} from '@angular/forms'

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
  
  saveUser:FormGroup;
  submitted:boolean = false;

  constructor(private registerService:RegisterService,private formbuilder:FormBuilder) { 
    this.saveUser = this.formbuilder.group({
      fname: new FormControl(null,[Validators.required]),                                                                                            
      lname: new FormControl(null,[Validators.required]),
      email: new FormControl(null,[Validators.required]),
      phone: new FormControl(null,[Validators.required]),
      password: new FormControl(null,[Validators.required,Validators.minLength(6)]),
      cpassword: new FormControl(null,[Validators.required])

    },{
      validators: this.MustMatch('password', 'cpassword')
    })
  }

  get f (){return this.saveUser.controls}

  MustMatch(controlName: string, matchingcontrolName:string){
   return(formGroup:FormGroup)=>{
     const control =formGroup.controls[controlName];
     const matchingcontrol =formGroup.controls[matchingcontrolName];
     if(matchingcontrol.errors && !matchingcontrol.errors.MustMatch){
        return
     }
     if(control.value !== matchingcontrol.value){
       matchingcontrol.setErrors({MustMatch:true});
     }
     else{
       matchingcontrol.setErrors(null);
     }
   }
  }
  addUser()
  {
    this.submitted = true;
    if(this.saveUser.invalid){
       return;
    }
    return this.registerService.saveUserData(this.saveUser.value);
  }

  // Added comment for barnch testing


  ngOnInit(): void {
  }
 
  

}
