using System;
using System.Runtime.Serialization;

namespace GeoRentWebService.Entities
{
    [DataContract]
    public class UserImageEntity
    {
        public UserImageEntity()
        {
            this.idUserImage = idUserImage;
        }

        [DataMember]
        public int idUserImage { get; set; }
        [DataMember]
        public String path { get; set; }
        [DataMember]
        public int resource { get; set; }
        [DataMember]
        public int order { get; set; }
        [DataMember]
        public virtual UserEntity idUser { get; set; }
    }
}