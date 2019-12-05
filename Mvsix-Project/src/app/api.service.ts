import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Usuario } from  './usuario';
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
    return this.httpClient.post<Usuario>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/Creacion.php`, usuario);
  }
  deleteUsuario1(id: number){
    return this.httpClient.delete<Usuario>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/Eliminacion.php/id=${id}`);
    
  }
  deleteUsuario(usuario: Usuario): Observable<Usuario>{
    return this.httpClient.post<Usuario>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/Eliminacion.php/?idUsuario=${usuario.idUsuario}`, usuario);
  }
}