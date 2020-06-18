import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Usuario } from  '../entities/usuario';
import { Tema } from  '../entities/tema';
import { Observable } from  'rxjs';
import { map } from  'rxjs/operators';
import { Playlist } from 'src/entities/playlist';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  
  constructor(private httpClient: HttpClient) {}
  
  PHP_API_SERVER = "http://localhost:80";
  readUsuarios(): Observable<Usuario[]>{
    return this.httpClient.get<Usuario[]>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/Lectura.php`);
  }
  readAmigos(usuario: Usuario): Observable<Usuario[]>{
    return this.httpClient.get<Usuario[]>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/LecturaAmigos.php/?idUsuario=${usuario.idUsuario}`);
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
  deleteAmigo(idUsuarios): Observable<Usuario>{
    console.log(idUsuarios);
    return this.httpClient.delete<Usuario>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/EliminacionAmigo.php/?idUsuarios=${idUsuarios}`);
  }
  loginUsuario(usuario: Usuario): Observable<Usuario>{
    return this.httpClient.post<Usuario>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/LecturaLogin.php`, usuario);
  }
  readTemas(): Observable<Tema[]>{
    return this.httpClient.get<Tema[]>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/LecturaTema.php`);
  }
  readTemasUsuario(usuario: Usuario): Observable<Tema[]>{
    return this.httpClient.get<Tema[]>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/LecturaTemasUsuario.php/?idUsuario=${usuario.idUsuario}`);
  }
  deleteTema(tema: Tema): Observable<Tema>{
    return this.httpClient.delete<Tema>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/EliminacionTema.php/?idTema=${tema.idTema}`);
  }
  createTema(tema: Tema, usuario: Usuario): Observable<Tema>{
    return this.httpClient.post<Tema>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/CreacionTema.php/?idUsuario=${usuario.idUsuario}`, tema);
  }
  updateTema(tema: Tema): Observable<Tema>{
    return this.httpClient.put<Tema>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/ActualizacionTema.php`, tema);
  }
  createPlaylist(playlist: Playlist): Observable<Playlist>{
    return this.httpClient.post<Playlist>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/CreacionTema.php`, playlist);
  }
  updatePlaylist(playlist: Playlist): Observable<Playlist>{
    return this.httpClient.post<Playlist>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/CreacionTema.php`, playlist);
  }
  readPlaylists(): Observable<Playlist[]>{
    return this.httpClient.get<Playlist[]>(`${this.PHP_API_SERVER}/PFC-DAWA/php/API/LecturaPlaylist.php`);
  }
}