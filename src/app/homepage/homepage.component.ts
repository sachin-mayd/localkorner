import { Component, OnInit } from '@angular/core';
import {CategoriesService} from '../service/categories.service';

@Component({
  selector: 'app-homepage',
  templateUrl: './homepage.component.html',
  styleUrls: ['./homepage.component.css']
})
export class HomepageComponent implements OnInit {
  categorydata:any=[];
  
  constructor(private categoriesService:CategoriesService) { }

  ngOnInit(){
    this.categoriesService.getCategorydata().subscribe(cdata=>{
      this.categorydata=cdata;
      console.warn(cdata)
    })
  }
}
