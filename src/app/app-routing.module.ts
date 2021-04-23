import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { ContactusComponent } from './contactus/contactus.component';
import { HomepageComponent } from './homepage/homepage.component';
import { AboutusComponent } from './aboutus/aboutus.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { CheckoutComponent } from './checkout/checkout.component';
import { MyaccountComponent } from './myaccount/myaccount.component';
import { WishlistComponent } from './wishlist/wishlist.component';
import { VerifyotpComponent } from './verifyotp/verifyotp.component';
import { ProductListComponent } from './product-list/product-list.component';
import { ProductDetailsComponent } from './product-details/product-details.component'
import { ShoppingcartComponent } from './shoppingcart/shoppingcart.component';

const routes: Routes = [
  { path: 'shopping_cart', component:ShoppingcartComponent},
  { path: 'product_details', component:ProductDetailsComponent},
  { path: 'product_list', component:ProductListComponent},
  { path: 'verifyotp', component:VerifyotpComponent},
  { path: 'wishlist', component:WishlistComponent},
  { path: 'myaccount', component:MyaccountComponent},
  { path: 'checkout', component:CheckoutComponent},
  { path: 'register', component:RegisterComponent},
  { path: 'login', component:LoginComponent},
  { path: 'contactus', component: ContactusComponent },
  { path: 'aboutus', component: AboutusComponent },
  { path: 'home', component: HomepageComponent },
  { path: '', component: HomepageComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
