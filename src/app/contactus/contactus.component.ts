import { Component, OnInit } from '@angular/core';
import {ContactService} from '../service/contact.service';
@Component({
  selector: 'app-contactus',
  templateUrl: './contactus.component.html',
  styleUrls: ['./contactus.component.css']
})
export class ContactusComponent implements OnInit {
  constructor(private contactService:ContactService) { }

  ngOnInit(): void {
  }
  onSubmit(data: any)
  {
    return this.contactService.saveContactUs(data);
    
  }

}
