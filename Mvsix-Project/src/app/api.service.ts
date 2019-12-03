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
    return this.httpClient.get<Usuario[]>(`http://localhost/PFC-DAWA/php/API/Lectura.php`);
  }
}