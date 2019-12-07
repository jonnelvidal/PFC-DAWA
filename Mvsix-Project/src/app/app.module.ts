import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from  '@angular/forms';
import { AppRoutingModule } from './app-routing.module';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import {NgxPaginationModule} from 'ngx-pagination';
import { PruebaComponent } from './prueba/prueba.component';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { UsuarioComponent } from './usuario/usuario.component';
import { BodyCenterComponent } from './body-center/body-center.component';



@NgModule({
  declarations: [      
    PruebaComponent, HeaderComponent, FooterComponent, UsuarioComponent, BodyCenterComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule,
    AppRoutingModule,
    NgbModule,
    NgxPaginationModule,
    
  ],
  providers: [],
  bootstrap: [HeaderComponent,FooterComponent,BodyCenterComponent]
})
export class AppModule { }
