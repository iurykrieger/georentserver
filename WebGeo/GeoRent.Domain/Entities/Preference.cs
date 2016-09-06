using System;
using System.Runtime.Serialization;

namespace GeoRent.Domain.Entities
{
    [DataContract]
    public class Preference
    {
        public Preference()
        {
            idPreference = Guid.NewGuid();
        }

        [DataMember]
        public Guid idPreference { get; set; }
        [DataMember]
        public bool sponsor { get; set; }
        [DataMember]
        public int room { get; set; }
        [DataMember]
        public int bathroom { get; set; }
        [DataMember]
        public int vacancy { get; set; }
        [DataMember]
        public bool laundry { get; set; }
        [DataMember]
        public float income { get; set; }
        [DataMember]
        public bool condominium { get; set; }
        [DataMember]
        public bool child { get; set; }
        [DataMember]
        public int stay { get; set; }
        [DataMember]
        public bool pet { get; set; }
        [DataMember]
        public virtual User idUser { get; set; }
        [DataMember]
        public virtual Residence idResidence { get; set; }
    }
}