import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { Routes, RouterModule } from '@angular/router';
import { PruebaComponent } from './prueba/prueba.component';

const routes: Routes = [
  { path: 'prueba', component: PruebaComponent }
];
@NgModule({
  declarations: [
    
  ],
  imports: [
    CommonModule
  ]
  
})
export class AppRoutingModule { 
  
}
