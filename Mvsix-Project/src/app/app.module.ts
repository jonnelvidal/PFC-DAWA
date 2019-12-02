import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { PruebaComponenteComponent } from './prueba-componente/prueba-componente.component';

@NgModule({
  declarations: [  
    PruebaComponenteComponent
  ],
  imports: [
    BrowserModule
  ],
  providers: [],
  bootstrap: [PruebaComponenteComponent]
})
export class AppModule { }
