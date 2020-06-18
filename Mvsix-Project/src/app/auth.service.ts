import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { isNullOrUndefined } from 'util';
import { LoginRoutingModule } from './usuario/login/login-routing.module';


@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http: HttpClient) { }
  headers: HttpHeaders = new HttpHeaders({
    "Content-Type": "application/json"
  });
  setUsuario(usuario) {
    let usuario_string = JSON.stringify(usuario);
    localStorage.setItem("usuarioActual", usuario_string);
  }
  getUsuario(){
    let usuario_string = localStorage.getItem("usuarioActual");
    if(!isNullOrUndefined(usuario_string)){
      let usuario = JSON.parse(usuario_string);
      return usuario;
    }else{
      return null;
    }
  }
  setToken(token): void {
    localStorage.setItem("accessToken", token);
  }
  getToken() {
    return localStorage.getItem("accessToken");
  }
  log_out(){
    let accessToken = localStorage.getItem('accessToken');
     
  }
}
