import { Component } from '@angular/core';
import { MenusService } from './service/menus.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'localcorner';
  menudata:any=[];
  constructor(private menusServices:MenusService){}
  ngOnInit(){
   this.menusServices.getMenudata().subscribe(mdata=>{
    this.menudata =mdata;
    console.warn(mdata)
   })
  }
  
}


