import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Playlist } from 'src/entities/playlist';

@Component({
  selector: 'app-playlist',
  templateUrl: './playlist.component.html',
  styleUrls: ['./playlist.component.css']
})
export class PlaylistComponent implements OnInit {
  playlist: Playlist[];
  playlistSeleccionado: Playlist ={idPlaylist: null, imagen: null,idUsuario: null,nombrePlaylist: null}
  constructor(private apiService: ApiService) { }
  createOrUpdatePlaylist(form){
    if(this.playlistSeleccionado && this.playlistSeleccionado.idPlaylist){
      form.value.idPlaylist = this.playlistSeleccionado.idPlaylist;
      console.log(form.value.idPlaylist);
      this.apiService.updatePlaylist(form.value).subscribe((playlist: Playlist)=>{
        console.log("Nombre Playlist cambiado" , playlist);
        this.ngOnInit();
      });
    }
    else{

      this.apiService.createPlaylist(form.value).subscribe((playlist: Playlist)=>{
        console.log("Playlist creado, ", playlist);
        this.ngOnInit();
      });
    }
  }
  ngOnInit() {
    this.apiService.readPlaylists().subscribe((playlist: Playlist[])=>{
      this.playlist = playlist;
      console.log(this.playlist)
    });
  }

}
