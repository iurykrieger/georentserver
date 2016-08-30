using System;

namespace GeoRent.Domain.Entities
{
    public class Preference
    {
        public bool sponsor { get; set; }
        public int room { get; set; }
        public int bathroom { get; set; }
        public int vacancy { get; set; }
        public bool laundry { get; set; }
        public float income { get; set; }
        public bool condominium { get; set; }
        public bool child { get; set; }
        public int stay { get; set; }
        public bool pet { get; set; }
        public virtual User idUser { get; set; }
        public virtual Residence idResidence { get; set; }
    }
}