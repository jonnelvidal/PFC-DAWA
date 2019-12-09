import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Usuario } from  '../entities/usuario';
import { Tema } from  '../entities/tema';
import { Observable } from  'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  
  constructor(private httpClient: HttpClient) {}
  
  PHP_API_SERVER = "http://localhost:80";
  readUsuarios(): Observable<Usuario[]>{
    return this.httpClient.get<Usuario[]>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/Lectura.php`);
  }
  createUsuario(usuario: Usuario): Observable<Usuario>{
    return this.httpClient.post<Usuario>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/Creacion.php`, usuario);
  }
  updateUsuario(usuario: Usuario): Observable<Usuario>{
    return this.httpClient.put<Usuario>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/Actualizacion.php`, usuario);
  }
  deleteUsuario(usuario: Usuario): Observable<Usuario>{
    return this.httpClient.delete<Usuario>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/Eliminacion.php/?idUsuario=${usuario.idUsuario}`);
  }
  loginUsuario(usuario: Usuario): Observable<Usuario>{
    return this.httpClient.post<Usuario>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/LecturaLogin.php`, usuario);
  }
  readTemas(): Observable<Tema[]>{
    return this.httpClient.get<Tema[]>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/LecturaTema.php`);
  }

}