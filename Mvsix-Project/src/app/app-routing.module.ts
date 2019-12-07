import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PruebaComponent } from './prueba/prueba.component';
import { UsuarioComponent } from './usuario/usuario.component';

const routes: Routes = [
  { path: 'prueba', component: PruebaComponent },
  { path: 'login', component: UsuarioComponent },
  { path: '', component: PruebaComponent}
];
@NgModule({
  declarations: [
    
  ],
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
  
})
export class AppRoutingModule { 
  
}
