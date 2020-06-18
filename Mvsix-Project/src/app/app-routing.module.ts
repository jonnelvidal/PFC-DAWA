import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { PersonaComponent } from './persona/persona.component';
import { TemaComponent } from './tema/tema.component';
import { PlaylistComponent } from './playlist/playlist.component';
import { InicioComponent } from './inicio/inicio.component';

const routes: Routes = [
  { path: 'persona', component: PersonaComponent },
  { path: 'tema', component: TemaComponent },
  { path: 'playlist', component: PlaylistComponent },
  { path: '', component: PersonaComponent},
  { path: 'inicio', component: InicioComponent},
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
