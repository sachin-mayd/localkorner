import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule } from '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { ContactusComponent } from './contactus/contactus.component';
import { HomepageComponent } from './homepage/homepage.component';
import { AboutusComponent } from './aboutus/aboutus.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { CheckoutComponent } from './checkout/checkout.component';
import { HttpClientModule } from '@angular/common/http';
import { MenusService } from './service/menus.service';
import { CategoriesService } from './service/categories.service';
import { RegisterService } from './service/register.service';
import { MyaccountComponent } from './myaccount/myaccount.component';
import { WishlistComponent } from './wishlist/wishlist.component';
import { VerifyotpComponent } from './verifyotp/verifyotp.component';
import { ProductListComponent } from './product-list/product-list.component';
import { ProductDetailsComponent } from './product-details/product-details.component'

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    ContactusComponent,
    HomepageComponent,
    AboutusComponent,
    LoginComponent,
    RegisterComponent,
    CheckoutComponent,
    MyaccountComponent,
    WishlistComponent,
    VerifyotpComponent,
    ProductListComponent,
    ProductDetailsComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    ReactiveFormsModule
   
    
  ],
  providers: [MenusService,CategoriesService,RegisterService],
  bootstrap: [AppComponent]
})
export class AppModule { }
