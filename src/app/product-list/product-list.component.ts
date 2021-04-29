import { Component, OnInit } from '@angular/core';
import {ProductsService} from '../service/products.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-product-list',
  templateUrl: './product-list.component.html',
  styleUrls: ['./product-list.component.css']
})
export class ProductListComponent implements OnInit {

  constructor(private productService:ProductsService,private route: ActivatedRoute) { }
  productdata:any=[];

  ngOnInit(): void {
    this.route.queryParams
      .subscribe(params => {
        if(params.gp == 'best_seller')
        {
             this.productService.getBestSeller().subscribe(cdata=>{
              this.productdata=cdata;
              console.warn(cdata)
            })
        }
        else if(params.gp == 'todays_deal')
        {
             this.productService.getBestSeller();
        }
        // this.orderby = params.orderby;
        // console.log(this.orderby); // price
      }
    );
  }

}
