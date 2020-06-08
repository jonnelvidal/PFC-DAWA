import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PruebaComponent } from './prueba/prueba.component';
import { TemaComponent } from './tema/tema.component';
import { PlaylistComponent } from './playlist/playlist.component';

const routes: Routes = [
  { path: 'prueba', component: PruebaComponent },
  { path: 'tema', component: TemaComponent },
  { path: 'playlist', component: PlaylistComponent },
  { path: '', component: PruebaComponent},
  { path: 'login', loadChildren: () => import('./usuario/login/login.module').then(m => m.LoginModule) },
  { path: 'perfil', loadChildren: () => import('./usuario/perfil/perfil.module').then(m => m.PerfilModule) },
  { path: 'registro', loadChildren: () => import('./usuario/registro/registro.module').then(m => m.RegistroModule) }
];
@NgModule({
  declarations: [
    
  ],
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
  
})
export class AppRoutingModule { 
  
}
