import { Component, OnInit, Inject } from '@angular/core';
import { Usuario } from 'src/entities/usuario';
import { ApiService } from '../api.service';
import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material/dialog';
import {ViewEncapsulation} from '@angular/core';
import { Routes } from '@angular/router';

const routes: Routes = [
  { path: 'login', loadChildren: () => import('./login/login.module').then(m => m.LoginModule) },
  { path: 'perfil', loadChildren: () => import('./perfil/perfil.module').then( m=> m.PerfilModule) },
  { path: 'registro', loadChildren: () =>import('./registro/registro.module').then( m=> m.RegistroModule) }
  
];
@Component({
  selector: 'app-login',
  templateUrl: './login/login.component.html',
  styleUrls: ['./login/login.component.css'],
  encapsulation: ViewEncapsulation.None 
})
export class UsuarioComponent implements OnInit {
  ngOnInit(): void {
  }
}