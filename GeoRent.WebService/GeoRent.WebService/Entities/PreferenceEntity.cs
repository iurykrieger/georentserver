using System;
using System.Runtime.Serialization;

namespace GeoRentWebService.Entities
{
    [DataContract]
    public class PreferenceEntity
    {
        public PreferenceEntity()
        {
            this.idPreference = idPreference;
        }

        [DataMember]
        public int idPreference { get; set; }
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
        public virtual UserEntity idUser { get; set; }
        [DataMember]
        public virtual ResidenceEntity idResidence { get; set; }
    }
}