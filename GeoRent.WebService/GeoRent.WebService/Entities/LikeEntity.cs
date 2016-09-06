using System;
using System.Runtime.Serialization;

namespace GeoRentWebService.Entities
{
    [DataContract]
    public class LikeEntity
    {
        public LikeEntity()
        {
            this.idLike = idLike;
        }

        [DataMember]
        public int idLike { get; set; }
        [DataMember]
        public bool like { get; set; }
        [DataMember]
        public DateTime dateTime { get; set; }
        [DataMember]
        public bool diamond { get; set; }
        [DataMember]
        public virtual ResidenceEntity Residence { get; set; }
        [DataMember]
        public virtual UserEntity idUser { get; set; }
    }
}